<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $email = '';

    public string $username = '';

    public string $phone = '';

    #[Locked]
    public ?string $avatar = null;

    #[Locked]
    public ?string $avatarUrl = null;

    public $avatar_file = null;

    #[Locked]
    public bool $emailVerified = false;

    #[Locked]
    public ?string $emailVerifiedAtLabel = null;

    #[Locked]
    public ?string $joinedAtLabel = null;

    #[Locked]
    public ?string $joinedHumanLabel = null;

    public function mount(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if ($user) {
            $this->syncUserState($user);
        }
    }

    /**
     * Validation rules for updating profile fields.
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $userId = Auth::id();

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'phone' => [
                'required',
                'string',
                'min:8',
                'max:25',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
        ];
    }

    /**
     * Automatically persist the avatar when FilePond uploads via wire:model.
     */
    public function updatedAvatarFile(): void
    {
        $this->saveAvatar();
    }

    /**
     * Validate and store the uploaded profile avatar image.
     */
    public function saveAvatar(): void
    {
        $this->validate([
            'avatar_file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:5120'],
        ]);

        /** @var User|null $user */
        $user = Auth::user();
        if (! $user || ! $this->avatar_file) {
            return;
        }

        $oldAvatar = $user->avatar ?? null;
        $disk = $this->avatarDisk();
        $uploadedPath = null;

        try {
            $stored = $this->avatar_file->store('avatars', $disk);
            if (is_string($stored) && $stored !== '') {
                $uploadedPath = $stored;
            }
        } catch (\Throwable $e) {
            Log::warning('Avatar upload failed on configured filesystem disk.', [
                'disk' => $disk,
                'error' => $e->getMessage(),
            ]);
        }

        if (! $uploadedPath) {
            $this->addError('avatar_file', __('validation.uploaded', ['attribute' => 'avatar_file']));

            return;
        }

        $user->forceFill(['avatar' => $uploadedPath])->save();

        $this->deleteStoredAvatar($oldAvatar, $uploadedPath);

        $this->avatar_file = null;
        $this->syncUserState($user->refresh());
        if (! $this->avatarUrl) {
            $this->avatarUrl = Storage::disk($disk)->url($uploadedPath);
        }

        $this->dispatch('profile-avatar-saved');
        $this->dispatch('toast', [
            'message' => __('vibe/settings.profile.avatar_saved_toast'),
            'type' => 'success',
            'title' => __('vibe/settings.profile.saved_title'),
        ]);
    }

    /**
     * Remove the user's stored profile avatar.
     */
    public function removeAvatar(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $oldAvatar = $user->avatar ?? null;

        $user->forceFill(['avatar' => null])->save();

        $this->deleteStoredAvatar($oldAvatar);

        $this->avatar_file = null;
        $this->syncUserState($user->refresh());

        $this->dispatch('profile-avatar-removed');
        $this->dispatch('toast', [
            'message' => __('vibe/settings.profile.avatar_removed_toast'),
            'type' => 'success',
            'title' => __('vibe/settings.profile.saved_title'),
        ]);
    }

    /**
     * Send a new email verification notification with rate limiting.
     */
    public function resendEmailVerification(): void
    {
        /** @var User|null $user */
        $user = Auth::user();
        if (! $user || ! method_exists($user, 'sendEmailVerificationNotification')) {
            return;
        }

        if (method_exists($user, 'hasVerifiedEmail') && $user->hasVerifiedEmail()) {
            $this->syncUserState($user);

            return;
        }

        $throttleKey = 'verify-email-profile|' . $user->id;
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->dispatch('toast', [
                'message' => __('vibe/settings.profile.verification_throttled', ['seconds' => $seconds]),
                'type' => 'warning',
                'title' => __('vibe/settings.profile.verification_title'),
            ]);

            return;
        }

        RateLimiter::hit($throttleKey, 600);
        $user->sendEmailVerificationNotification();

        $this->dispatch('toast', [
            'message' => __('vibe/settings.profile.verification_sent_toast'),
            'type' => 'success',
            'title' => __('vibe/settings.profile.verification_title'),
        ]);
    }

    /**
     * Update the authenticated user's profile information.
     */
    public function updateProfile(): void
    {
        $validated = $this->validate();

        /** @var User|null $user */
        $user = Auth::user();
        if (! $user) {
            return;
        }

        $emailChanged = strcasecmp((string) $user->email, (string) $validated['email']) !== 0;

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
        ]);

        if ($emailChanged && $user instanceof MustVerifyEmail) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($emailChanged && $user instanceof MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }

        $this->syncUserState($user->refresh());

        $this->dispatch('toast', [
            'message' => __('vibe/settings.profile.saved_toast'),
            'type' => 'success',
            'title' => __('vibe/settings.profile.saved_title'),
        ]);
    }

    /**
     * Resolve the filesystem disk used for storing user avatars.
     */
    protected function avatarDisk(): string
    {
        $default = (string) config('filesystems.default', 'local');

        return $default === 'local' ? 'public' : $default;
    }

    /**
     * Synchronize public profile component properties from the User model.
     */
    protected function syncUserState(User $user): void
    {
        $this->name = (string) $user->name;
        $this->email = (string) $user->email;
        $this->username = (string) ($user->username ?? '');
        $this->phone = (string) ($user->phone ?? '');
        $this->avatar = $user->avatar ?? null;
        $this->avatarUrl = $this->resolveAvatarUrl($user);
        $this->emailVerified = $user instanceof MustVerifyEmail
            ? $user->hasVerifiedEmail()
            : ! empty($user->email_verified_at);
        $this->emailVerifiedAtLabel = $user->email_verified_at?->translatedFormat('d M Y, H:i');
        $this->joinedAtLabel = $user->created_at?->translatedFormat('d M Y');
        $this->joinedHumanLabel = $user->created_at?->diffForHumans();
    }

    /**
     * Resolve the public URL for the user's avatar with fallback when accessor is unavailable.
     */
    protected function resolveAvatarUrl(User $user): ?string
    {
        if (! empty($user->avatar_url)) {
            return (string) $user->avatar_url;
        }

        $avatar = $user->avatar ?? null;
        if (! is_string($avatar) || $avatar === '') {
            return null;
        }

        if (str_starts_with($avatar, 'http://') || str_starts_with($avatar, 'https://')) {
            return $avatar;
        }

        try {
            return Storage::disk($this->avatarDisk())->url($avatar);
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Safely delete an obsolete stored avatar file from the disk.
     */
    protected function deleteStoredAvatar(?string $oldAvatar, ?string $currentPath = null): void
    {
        if (
            ! $oldAvatar
            || $oldAvatar === $currentPath
            || str_starts_with($oldAvatar, 'http://')
            || str_starts_with($oldAvatar, 'https://')
        ) {
            return;
        }

        try {
            Storage::disk($this->avatarDisk())->delete($oldAvatar);
        } catch (\Throwable) {
        }
    }

    public function render(): View
    {
        return view('livewire.settings.profile');
    }
}
