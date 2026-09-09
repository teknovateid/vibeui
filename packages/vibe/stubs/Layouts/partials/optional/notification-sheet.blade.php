<vibe:sheet id="notification-sheet" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" persist>
    <vibe:sheet.header class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="font-semibold text-sm text-foreground">Notifications</span>
            <span class="text-[10px] font-medium bg-muted text-muted-foreground px-2 py-0.5 rounded-full">3 new</span>
        </div>
        <vibe:sheet.close />
    </vibe:sheet.header>

    <vibe:sheet.content class="p-2 divide-y divide-border">
        <!-- Notification Item 1 -->
        <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                    <span class="size-2 rounded-full bg-primary"></span>
                    System Update
                </span>
                <span class="text-[10px] text-muted-foreground">Just now</span>
            </div>
            <p class="text-xs text-muted-foreground pl-3.5">
                Your application layout has been successfully initialized.
            </p>
        </div>

        <!-- Notification Item 2 -->
        <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                    <span class="size-2 rounded-full bg-emerald-500"></span>
                    Welcome to Vibe UI
                </span>
                <span class="text-[10px] text-muted-foreground">1h ago</span>
            </div>
            <p class="text-xs text-muted-foreground pl-3.5">
                Explore the compound components, forms, tables, and dialogs.
            </p>
        </div>

        <!-- Notification Item 3 -->
        <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                    <span class="size-2 rounded-full bg-amber-500"></span>
                    Daily Backup
                </span>
                <span class="text-[10px] text-muted-foreground">3h ago</span>
            </div>
            <p class="text-xs text-muted-foreground pl-3.5">
                Automated database backup completed with zero errors.
            </p>
        </div>
    </vibe:sheet.content>

    <vibe:sheet.footer class="p-3">
        <vibe:button variant="outline" size="sm" class="w-full text-xs">
            Mark all as read
        </vibe:button>
    </vibe:sheet.footer>
</vibe:sheet>
