    
     <div class="space-y-6">
        <div class="rounded-2xl overflow-hidden  p-6 relative" style="background: linear-gradient(90deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));">
            @if($background)
                <div class="absolute inset-0" style="background-image: url('{{ $background }}'); background-size: cover; background-position: center; opacity: .15;"></div>
            @endif

            <div class="relative z-10 flex items-center gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-semibold">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="mt-1 text-sm text-muted-foreground">{{ $subtitle }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                       <x-filament::input.wrapper>
                         <x-slot name="prefix">Tahun : 
</x-slot>

                        <x-filament::input.select wire:model.live="selectedYear">
                        <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="">
        <div class="rounded-2xl overflow-hidden p-6 relative">

               <div class=" z-10 flex items-center gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-semibold">{{ $title }}</h1>
                    @if($subtitle)
                        <p class="mt-1 text-sm text-muted-foreground">{{ $subtitle }}</p>
                    @endif
                     <div class="flex items-center gap-2 justify-end">
                    <x-filament::input.wrapper>
                        <x-filament::input.select wire:model.live="selectedYear">
                        <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                </div>
                </div>
            </div>
        </div>
    </div> --}}