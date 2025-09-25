<div class="min-h-screen bg-main relative overflow-hidden">
    <!-- Advanced Animated Background -->
    <div class="absolute inset-0">
        <!-- Flowing gradient mesh -->
        <div class="absolute inset-0 opacity-60">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-accent-500/20 via-purple-500/15 to-blue-500/20 animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute inset-0 bg-gradient-to-tl from-emerald-500/15 via-transparent to-cyan-500/20 animate-pulse" style="animation-duration: 12s; animation-delay: 2s;"></div>
        </div>

        <!-- Floating elements -->
        <div class="absolute top-20 left-20 w-3 h-3 bg-accent-500/50 rounded-full animate-bounce hover:scale-150 hover:bg-accent-400 transition-all duration-500 cursor-pointer"></div>
        <div class="absolute top-1/3 right-24 w-2 h-8 bg-purple-500/50 animate-pulse hover:h-16 hover:bg-purple-400 transition-all duration-400 cursor-pointer"></div>
        <div class="absolute bottom-1/4 left-1/4 w-4 h-4 bg-emerald-500/50 rotate-45 animate-spin hover:scale-200 transition-all duration-600 cursor-pointer" style="animation-duration: 15s;"></div>
        <div class="absolute bottom-20 right-20 w-12 h-1 bg-blue-500/50 animate-pulse hover:w-20 transition-all duration-500 cursor-pointer"></div>
    </div>

    <!-- Mobile Layout (Small Screens) -->
    <div class="lg:hidden min-h-screen flex flex-col">
        <!-- Mobile Header -->
        <div class="relative z-10 p-6">
            <div class="flex items-center justify-center">
                <div class="inline-flex items-center space-x-3 bg-card/90 backdrop-blur-xl rounded-2xl px-6 py-3 border border-border-main/50 shadow-xl">
                    <div class="w-10 h-10 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-fg-1 text-lg">TechFlow Solutions</h1>
                        <p class="text-fg-3 text-xs">Digital Innovation Platform</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Login Form -->
        <div class="flex-1 flex items-center justify-center px-6 pb-6">
            <div class="w-full max-w-sm mx-auto">
                <!-- Glassmorphism backdrop -->
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-accent-500/20 via-purple-500/20 to-blue-500/20 rounded-3xl filter blur-xl opacity-60"></div>
                    
                    <!-- Main card -->
                    <div class="relative bg-card/95 backdrop-blur-2xl rounded-3xl border border-border-main/50 shadow-2xl p-6">
                        
                        <!-- Header -->
                        <div class="text-center mb-6">
                            <div class="relative inline-block mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mx-auto shadow-xl">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h2 class="text-xl font-bold text-fg-1 mb-1">Employee Portal</h2>
                            <p class="text-fg-3 text-sm">Masuk ke dashboard perusahaan</p>
                        </div>

                        <!-- Mobile Form -->
                        <form wire:submit="login" class="space-y-4">
                            <div class="space-y-4">
                                <x-ts-input 
                                    label="Email Address" 
                                    type="email" 
                                    wire:model="email" 
                                    icon="envelope"
                                    placeholder="youraccount@gmail.com"
                                    class="text-sm" 
                                    required 
                                />

                                <x-ts-password 
                                    label="Password" 
                                    wire:model="password" 
                                    icon="key"
                                    placeholder="Masukkan password Anda"
                                    class="text-sm" 
                                    required 
                                />
                            </div>

                            <div class="flex items-center justify-between pt-2">
                                <x-ts-checkbox 
                                    wire:model="remember" 
                                    label="Ingat saya" 
                                    id="remember"
                                    class="text-xs" 
                                />
                                <a href="#" class="text-xs font-medium text-accent-600 hover:text-accent-700">
                                    Lupa Password?
                                </a>
                            </div>

                            <div class="pt-4">
                                <x-buttons.button 
                                    type="submit" 
                                    color="primary"
                                    target="login" 
                                    iconClass="ti ti-login-2"
                                    iconPosition="right"
                                    class="w-full text-sm font-semibold rounded-xl shadow-xl gap-x-2"
                                >
                                    Masuk ke Dashboard
                                </x-buttons.button>
                            </div>
                        </form>

                        <!-- Mobile Actions -->
                        <div class="mt-6 pt-4 border-t border-border-main/30">
                            <div class="text-center text-xs text-fg-3 mb-3">Butuh bantuan?</div>
                            <div class="flex gap-2">
                                <x-ts-button 
                                    color="secondary" 
                                    outline
                                    class="flex-1 justify-center h-10 rounded-lg text-xs"
                                >
                                    <x-slot:text>Panduan</x-slot:text>
                                </x-ts-button>
                                <x-ts-button 
                                    color="secondary" 
                                    outline
                                    class="flex-1 justify-center h-10 rounded-lg text-xs"
                                >
                                    <x-slot:text>IT Support</x-slot:text>
                                </x-ts-button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Status -->
                <div class="mt-6 flex justify-center">
                    <div class="inline-flex items-center gap-3 bg-card/80 backdrop-blur-xl rounded-full px-4 py-2 border border-border-main/40 shadow-lg">
                        <div class="flex items-center gap-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs text-fg-3 font-medium">Online</span>
                        </div>
                        <div class="w-px h-3 bg-border-main/50"></div>
                        <div class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-xs text-fg-3 font-medium">Secure</span>
                        </div>
                    </div>
                </div>

                <!-- Mobile Footer -->
                <div class="text-center mt-4">
                    <p class="text-xs text-fg-3 font-medium">
                        © {{ date('Y') }} TechFlow Solutions
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Layout (Large Screens) -->
    <div class="hidden lg:block">
        <div class="relative min-h-screen flex">
            
            <!-- Left Panel: Company Showcase -->
            <div class="w-3/5 relative overflow-hidden group">
                <!-- Background with modern clip-path -->
                <div class="absolute inset-0 bg-gradient-to-br from-accent-600 via-accent-700 to-purple-800 transition-all duration-1000 hover:from-accent-500 hover:via-accent-600 hover:to-purple-700" style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0 100%);"></div>

                <!-- Subtle pattern overlay -->
                <div class="absolute inset-0 opacity-10">
                    <div class="w-full h-full" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px;"></div>
                </div>

                <!-- Content Container -->
                <div class="relative z-10 h-full flex flex-col justify-between p-16 text-white">

                    <!-- Header Section -->
                    <div class="space-y-8">
                        <!-- Company Logo & Brand -->
                        <div class="flex items-center space-x-4 group/brand">
                            <div class="relative">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30 hover:bg-white/30 hover:scale-110 hover:rotate-6 transition-all duration-500 cursor-pointer">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold tracking-tight text-white dark:text-fg-1">TechFlow Solutions</h1>
                                <p class="text-white/80 text-sm">Digital Innovation Platform</p>
                            </div>
                        </div>

                        <!-- Main Value Proposition -->
                        <div class="space-y-6 max-w-2xl">
                            <div class="inline-flex items-center px-4 py-2 bg-white/15 backdrop-blur-sm rounded-full border border-white/20 hover:bg-white/25 transition-all duration-300">
                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse mr-3"></div>
                                <span class="text-sm font-medium tracking-wide">ENTERPRISE SOLUTION</span>
                            </div>

                            <h2 class="text-5xl lg:text-6xl font-bold leading-tight tracking-tight">
                                <span class="block text-white dark:text-fg-1 hover:text-yellow-200 transition-colors duration-300 cursor-default">Transform</span>
                                <span class="block text-white/90 hover:text-white hover:translate-x-2 inline-block transition-all duration-300 cursor-default">Your Business</span>
                                <span class="block text-white/80 hover:text-white hover:translate-x-4 inline-block transition-all duration-300 cursor-default">Digitally</span>
                            </h2>

                            <p class="text-xl text-white/90 leading-relaxed hover:text-white transition-colors duration-300 cursor-default">
                                Platform terintegrasi untuk mengelola seluruh aspek bisnis Anda. Dari manajemen inventori hingga analitik real-time, semua dalam satu dashboard yang powerful.
                            </p>
                        </div>
                    </div>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-6 my-12">
                        <div class="group/card bg-black/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 hover:scale-105 hover:rotate-1 transition-all duration-500 cursor-pointer">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center group-hover/card:bg-emerald-400 group-hover/card:rotate-12 group-hover/card:scale-110 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white mb-2 group-hover/card:translate-x-1 transition-transform duration-300">Real-time Analytics</h3>
                                    <p class="text-white/80 text-sm group-hover/card:text-white transition-colors duration-300">Dashboard analitik dengan insights mendalam untuk pengambilan keputusan yang tepat</p>
                                </div>
                            </div>
                        </div>

                        <div class="group/card bg-black/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 hover:scale-105 hover:-rotate-1 transition-all duration-500 cursor-pointer">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center group-hover/card:bg-blue-400 group-hover/card:rotate-12 group-hover/card:scale-110 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white mb-2 group-hover/card:translate-x-1 transition-transform duration-300">Enterprise Security</h3>
                                    <p class="text-white/80 text-sm group-hover/card:text-white transition-colors duration-300">Keamanan tingkat enterprise dengan enkripsi end-to-end dan audit trail lengkap</p>
                                </div>
                            </div>
                        </div>

                        <div class="group/card bg-black/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 hover:scale-105 hover:rotate-1 transition-all duration-500 cursor-pointer">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center group-hover/card:bg-purple-400 group-hover/card:rotate-12 group-hover/card:scale-110 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white mb-2 group-hover/card:translate-x-1 transition-transform duration-300">AI-Powered Automation</h3>
                                    <p class="text-white/80 text-sm group-hover/card:text-white transition-colors duration-300">Otomatisasi cerdas yang mempercepat workflow dan mengurangi human error</p>
                                </div>
                            </div>
                        </div>

                        <div class="group/card bg-black/20 backdrop-blur-sm rounded-2xl p-6 border border-white/20 hover:bg-white/20 hover:scale-105 hover:-rotate-1 transition-all duration-500 cursor-pointer">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center group-hover/card:bg-orange-400 group-hover/card:rotate-12 group-hover/card:scale-110 transition-all duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-white mb-2 group-hover/card:translate-x-1 transition-transform duration-300">Multi-Platform Access</h3>
                                    <p class="text-white/80 text-sm group-hover/card:text-white transition-colors duration-300">Akses dari mana saja, kapan saja melalui web, mobile, dan desktop application</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Stats -->
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-8">
                            <div class="text-center cursor-pointer hover:scale-110 hover:-translate-y-2 transition-all duration-300 group/stat">
                                <div class="text-3xl font-bold text-white group-hover/stat:text-yellow-200 transition-colors duration-300">2,500+</div>
                                <div class="text-sm text-white/80 group-hover/stat:text-white transition-colors duration-300">Active Users</div>
                            </div>
                            <div class="text-center cursor-pointer hover:scale-110 hover:-translate-y-2 transition-all duration-300 group/stat">
                                <div class="text-3xl font-bold text-white group-hover/stat:text-emerald-200 transition-colors duration-300">99.9%</div>
                                <div class="text-sm text-white/80 group-hover/stat:text-white transition-colors duration-300">Uptime</div>
                            </div>
                            <div class="text-center cursor-pointer hover:scale-110 hover:-translate-y-2 transition-all duration-300 group/stat">
                                <div class="text-3xl font-bold text-white group-hover/stat:text-blue-200 transition-colors duration-300">24/7</div>
                                <div class="text-sm text-white/80 group-hover/stat:text-white transition-colors duration-300">Support</div>
                            </div>
                        </div>

                        <!-- Performance indicator -->
                        <div class="transform rotate-12 hover:rotate-0 hover:scale-110 transition-all duration-500 cursor-pointer group/perf">
                            <div class="bg-black/20 backdrop-blur-sm rounded-xl p-4 border border-white/20 hover:bg-white/25 transition-all duration-300">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <div class="text-sm font-medium text-white group-hover/perf:text-green-200 transition-colors duration-200">System Optimal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Desktop Login Form -->
            <div class="w-2/5 flex items-center justify-center p-8">
                <div class="w-full max-w-md mx-auto">
                    <!-- Glassmorphism backdrop -->
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-accent-500/20 via-purple-500/20 to-blue-500/20 rounded-3xl filter blur-xl opacity-60 group-hover:opacity-100 transition-all duration-700"></div>
                        
                        <!-- Main card -->
                        <div class="relative bg-card/95 backdrop-blur-2xl rounded-3xl border border-border-main/50 shadow-2xl p-8 hover:bg-card hover:border-border-main/70 hover:shadow-3xl transition-all duration-500 group">
                            
                            <!-- Header -->
                            <div class="text-center mb-8">
                                <div class="relative inline-block mb-6">
                                    <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-600 rounded-3xl flex items-center justify-center mx-auto shadow-2xl hover:rotate-12 hover:scale-110 transition-all duration-500 cursor-pointer group/icon">
                                        <svg class="w-10 h-10 text-white group-hover/icon:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-0 rounded-3xl border-2 border-accent-500/30 animate-ping"></div>
                                </div>
                                
                                <h2 class="text-3xl font-bold text-fg-1 mb-2 hover:scale-105 hover:text-accent-600 transition-all duration-300 cursor-default">Employee Portal</h2>
                                <p class="text-fg-3 hover:text-fg-2 transition-colors duration-300 cursor-default">Masuk ke dashboard Anda untuk akses penuh ke semua fitur perusahaan</p>
                            </div>

                            <!-- Login Form -->
                            <form wire:submit="login" class="space-y-6">
                                <div class="space-y-6">
                                    <div class="group/input relative">
                                        <x-ts-input 
                                            label="Email Address" 
                                            type="email" 
                                            wire:model="email" 
                                            icon="envelope"
                                            placeholder="youraccount@gmail.com"
                                        />
                                    </div>

                                    <div class="group/input relative">
                                        <x-ts-password 
                                            label="Password" 
                                            wire:model="password" 
                                            icon="key"
                                            placeholder="Masukkan password Anda"
                                        />
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4">
                                    <div class="hover:scale-105 transition-transform duration-200">
                                        <x-ts-checkbox 
                                            wire:model="remember" 
                                            label="Ingat saya" 
                                            id="remember"
                                            class="text-sm" 
                                        />
                                    </div>
                                    <a href="#" class="text-sm font-medium text-accent-600 hover:text-accent-700 hover:scale-105 transition-all duration-200 group/forgot">
                                        <span class="border-b border-transparent group-hover/forgot:border-accent-600 transition-all duration-200">Lupa Password?</span>
                                        <svg class="w-3 h-3 inline-block ml-1 group-hover/forgot:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="pt-6">
                                    <x-buttons.button 
                                        type="submit" 
                                        color="primary"
                                        target="login" 
                                        iconClass="ti ti-login-2"
                                        iconPosition="right"
                                        class="w-full text-lg font-bold rounded-2xl relative overflow-hidden gap-x-2"
                                    >
                                        <span class="group-hover/submit:tracking-wider transition-all duration-300">Masuk ke Dashboard</span>
                                    </x-buttons.button>
                                </div>
                            </form>

                            <!-- Additional Actions -->
                            <div class="mt-8 pt-6 border-t border-border-main/30">
                                <div class="text-center text-sm text-fg-3 mb-4 hover:text-fg-2 transition-colors duration-300 cursor-default">Butuh bantuan?</div>
                                <div class="flex gap-3">
                                    <x-ts-button 
                                        color="secondary" 
                                        outline
                                        class="flex-1 justify-center h-12 rounded-xl hover:bg-bg-2 hover:scale-105 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group/help"
                                    >
                                        <x-slot:text>
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4 group-hover/help:rotate-12 group-hover/help:scale-110 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="group-hover/help:tracking-wide transition-all duration-300">Panduan</span>
                                            </span>
                                        </x-slot:text>
                                    </x-ts-button>

                                    <x-ts-button 
                                        color="secondary" 
                                        outline
                                        class="flex-1 justify-center h-12 rounded-xl hover:bg-bg-2 hover:scale-105 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group/support"
                                    >
                                        <x-slot:text>
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4 group-hover/support:scale-110 group-hover/support:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                </svg>
                                                <span class="group-hover/support:tracking-wide transition-all duration-300">IT Support</span>
                                            </span>
                                        </x-slot:text>
                                    </x-ts-button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Bar -->
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex items-center gap-4 bg-card/80 backdrop-blur-xl rounded-full px-6 py-3 border border-border-main/40 shadow-xl hover:bg-card/90 hover:shadow-2xl hover:scale-105 transition-all duration-400 cursor-pointer group/status">
                            <div class="flex items-center gap-2 hover:scale-110 transition-transform duration-300">
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse group-hover/status:scale-150 transition-transform duration-300"></div>
                                <span class="text-xs text-fg-3 font-medium group-hover/status:text-fg-1 transition-colors duration-300">Server Online</span>
                            </div>
                            <div class="w-px h-4 bg-border-main/50"></div>
                            <div class="flex items-center gap-2 hover:scale-110 transition-transform duration-300">
                                <svg class="w-3 h-3 text-blue-500 group-hover/status:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-xs text-fg-3 font-medium group-hover/status:text-fg-1 transition-colors duration-300">Response 45ms</span>
                            </div>
                            <div class="w-px h-4 bg-border-main/50"></div>
                            <div class="flex items-center gap-2 hover:scale-110 transition-transform duration-300">
                                <svg class="w-3 h-3 text-purple-500 group-hover/status:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span class="text-xs text-fg-3 font-medium group-hover/status:text-fg-1 transition-colors duration-300">Secure SSL</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center mt-6">
                        <p class="text-xs text-fg-3 hover:text-fg-1 hover:scale-105 transition-all duration-300 cursor-default font-medium">
                            © {{ date('Y') }} TechFlow Solutions • Sistem Manajemen Terintegrasi v3.2.1
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
