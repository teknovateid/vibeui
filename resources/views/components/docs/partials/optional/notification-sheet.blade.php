 <vibe:sheet id="notification-sheet" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" persist>
     <vibe:sheet.header class="flex items-center justify-between">
         <div class="flex items-center gap-2">
             <span class="font-semibold text-sm text-foreground">{{ __('docs/sidebar.notifications.title') }}</span>
             <span class="text-[10px] font-medium bg-muted text-muted-foreground px-2 py-0.5 rounded-full">{{ __('docs/sidebar.notifications.new', ['count' => 3]) }}</span>
         </div>
         <vibe:sheet.close />
     </vibe:sheet.header>

     <vibe:sheet.content class="p-2 divide-y divide-border">
         <!-- Notification Item 1 -->
         <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
             <div class="flex items-center justify-between">
                 <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                     <span class="size-2 rounded-full bg-primary"></span>
                     Pembaruan Sistem
                 </span>
                 <span class="text-[10px] text-muted-foreground">2 menit lalu</span>
             </div>
             <p class="text-xs text-muted-foreground pl-3.5">
                 Vibe UI versi terbaru telah aktif dengan fitur dan peningkatan performa.
             </p>
         </div>

         <!-- Notification Item 2 -->
         <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
             <div class="flex items-center justify-between">
                 <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                     <span class="size-2 rounded-full bg-green-500"></span>
                     Pengguna Baru
                 </span>
                 <span class="text-[10px] text-muted-foreground">1 jam lalu</span>
             </div>
             <p class="text-xs text-muted-foreground pl-3.5">
                 Pengguna baru baru saja mendaftarkan akun di sistem.
             </p>
         </div>

         <!-- Notification Item 3 -->
         <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
             <div class="flex items-center justify-between">
                 <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                     <span class="size-2 rounded-full bg-amber-500"></span>
                     Backup Selesai
                 </span>
                 <span class="text-[10px] text-muted-foreground">3 jam lalu</span>
             </div>
             <p class="text-xs text-muted-foreground pl-3.5">
                 Backup harian database telah berhasil disimpan dengan aman.
             </p>
         </div>
     </vibe:sheet.content>

     <vibe:sheet.footer class="p-3">
         <vibe:button variant="outline" size="sm" class="w-full text-xs">
             Tandai Semua Sudah Dibaca
         </vibe:button>
     </vibe:sheet.footer>
 </vibe:sheet>
