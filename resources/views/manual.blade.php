<x-layouts.app>
    <div class="max-w-4xl mx-auto px-4 py-12 relative min-h-screen font-mono">
        <!-- Header -->
        <div class="mb-16 border-b border-gray-800 pb-8 text-center animate-fade-in-up">
            <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-300 to-gray-600 tracking-tighter mb-4">
                ECOSYSTEM MANUAL
            </h1>
            <p class="text-gray-400 text-sm md:text-base max-w-2xl leading-relaxed mx-auto">
                Official operational doctrine for orchestrating the Hexadella privacy ecosystem. The following scenarios are engineered to ensure absolute Operational Security (OpSec).
            </p>
        </div>

        <div class="flex flex-col relative items-center animate-fade-in-up" style="animation-delay: 0.1s;">
            <!-- Content Area -->
            <div class="w-full max-w-3xl space-y-16">

                <!-- Scenario 01 -->
                <div id="scenario-01" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-purple-900/40 text-purple-400 px-2 py-1 rounded text-xs font-bold border border-purple-500/20">SCENARIO 01</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Ghost Courier</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-purple-500 p-6 rounded-r-xl">
                        <p class="text-sm text-gray-400 mb-6 italic">"Deployed for transmitting highly sensitive payloads to external parties without leaving server footprints, metadata, or message history."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Shredella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-teal-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-teal-500/10 border border-teal-500/20 flex items-center justify-center mb-2 text-teal-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-teal-400 tracking-wide">Shredella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Vaultella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-emerald-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mb-2 text-emerald-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-emerald-400 tracking-wide">Vaultella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Notella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-cyan-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-2 text-cyan-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-cyan-400 tracking-wide">Notella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-purple-500 font-bold">01.</span> <div>Sanitize the target payload from GPS coordinates and EXIF metadata utilizing <a href="/shredella" class="text-teal-400 hover:underline">Shredella</a>.</div></li>
                            <li class="flex gap-4"><span class="text-purple-500 font-bold">02.</span> <div>Seal the sterilized asset within <a href="/vaultella" class="text-emerald-400 hover:underline">Vaultella</a> to generate a single-use vault link.</div></li>
                            <li class="flex gap-4"><span class="text-purple-500 font-bold">03.</span> <div>Embed the Vaultella URI inside a <a href="/notella" class="text-cyan-400 hover:underline">Notella</a> burn-after-reading note.</div></li>
                            <li class="flex gap-4"><span class="text-purple-500 font-bold">04.</span> <div>Transmit the Notella link to the recipient. Transmission concludes with zero residual dust.</div></li>
                        </ol>
                    </div>
                </div>

                <!-- Scenario 02 -->
                <div id="scenario-02" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-amber-900/40 text-amber-400 px-2 py-1 rounded text-xs font-bold border border-amber-500/20">SCENARIO 02</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Dead Drop</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-amber-500 p-6 rounded-r-xl">
                        <p class="text-sm text-gray-400 mb-6 italic">"Executing a blind extraction: prompting unidentified sources to hand over documents while guaranteeing their absolute anonymity."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Shredella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-teal-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-teal-500/10 border border-teal-500/20 flex items-center justify-center mb-2 text-teal-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-teal-400 tracking-wide">Shredella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Dropella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-amber-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mb-2 text-amber-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-amber-400 tracking-wide">Dropella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-amber-500 font-bold">01.</span> <div>Instruct your informant to scrub their visual assets via <a href="/shredella" class="text-teal-400 hover:underline">Shredella</a> prior to transmission.</div></li>
                            <li class="flex gap-4"><span class="text-amber-500 font-bold">02.</span> <div>Command them to toss the sterilized payload into your designated <a href="/dropella" class="text-amber-400 hover:underline">Dropella</a> dead drop zone.</div></li>
                        </ol>
                    </div>
                </div>

                <!-- Scenario 03 -->
                <div id="scenario-03" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-rose-900/40 text-rose-400 px-2 py-1 rounded text-xs font-bold border border-rose-500/20">SCENARIO 03</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Burner Rendezvous</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-rose-500 p-6 rounded-r-xl">
                        <p class="text-sm text-gray-400 mb-6 italic">"Initiating a real-time bilateral communication channel with an anonymous source while maintaining absolute mutual blindness."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Maskella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-rose-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center mb-2 text-rose-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-rose-400 tracking-wide">Maskella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Whisperella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-purple-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center mb-2 text-purple-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-purple-400 tracking-wide">Whisperella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-rose-500 font-bold">01.</span> <div>Broadcast your <a href="/maskella" class="text-rose-400 hover:underline">Maskella</a> URI to the designated target.</div></li>
                            <li class="flex gap-4"><span class="text-rose-500 font-bold">02.</span> <div>The informant dispatches an agreed-upon rendezvous timestamp or security code via the Maskella inbox.</div></li>
                            <li class="flex gap-4"><span class="text-rose-500 font-bold">03.</span> <div>Acknowledge by releasing a <a href="/whisperella" class="text-purple-400 hover:underline">Whisperella</a> session key. Dialogue executes purely in RAM, detonating permanently post-session.</div></li>
                        </ol>
                    </div>
                </div>

                <!-- Scenario 04 -->
                <div id="scenario-04" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-cyan-900/40 text-cyan-400 px-2 py-1 rounded text-xs font-bold border border-cyan-500/20">SCENARIO 04</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Public Echo</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-cyan-500 p-6 rounded-r-xl">
                        <p class="text-sm text-gray-400 mb-6 italic">"Broadcasting classified intelligence to a crowd while restricting full extraction to the swiftest observer."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Notella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-cyan-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-2 text-cyan-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-cyan-400 tracking-wide">Notella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Havenella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-gray-300/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-300/10 border border-gray-300/20 flex items-center justify-center mb-2 text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-300 tracking-wide">Havenella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-cyan-500 font-bold">01.</span> <div>Secure the critical intel inside <a href="/notella" class="text-cyan-400 hover:underline">Notella</a> to generate a volatile read-once URI.</div></li>
                            <li class="flex gap-4"><span class="text-cyan-500 font-bold">02.</span> <div>Draft an anonymous bulletin on the <a href="/havenella" class="text-gray-300 hover:underline">Havenella</a> board to bait attention, embedding the Notella link within the payload.</div></li>
                            <li class="flex gap-4"><span class="text-cyan-500 font-bold">03.</span> <div>The most rapid observer to execute the Notella link secures the full secret; subsequent visitors encounter only digital ashes.</div></li>
                        </ol>
                    </div>
                </div>

                <!-- Scenario 05 -->
                <div id="scenario-05" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-pink-900/40 text-pink-400 px-2 py-1 rounded text-xs font-bold border border-pink-500/20">SCENARIO 05</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Horcrux</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-pink-500 p-6 rounded-r-xl">
                        <p class="text-sm text-gray-400 mb-6 italic">"Securing a Master Password or Crypto Key by fracturing it, ensuring no single entity wields absolute authority."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Splitella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-pink-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-pink-500/10 border border-pink-500/20 flex items-center justify-center mb-2 text-pink-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-pink-400 tracking-wide">Splitella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Notella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-cyan-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center mb-2 text-cyan-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-cyan-400 tracking-wide">Notella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Dropella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-amber-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mb-2 text-amber-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-amber-400 tracking-wide">Dropella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-pink-500 font-bold">01.</span> <div>Fracture the master key via <a href="/splitella" class="text-pink-400 hover:underline">Splitella</a> into shards requiring a minority consensus to unlock.</div></li>
                            <li class="flex gap-4"><span class="text-pink-500 font-bold">02.</span> <div>Dispatch these shards individually to geographically dispersed trusted contacts utilizing <a href="/notella" class="text-cyan-400 hover:underline">Notella</a>.</div></li>
                            <li class="flex gap-4"><span class="text-pink-500 font-bold">03.</span> <div>When an emergency necessitates key recovery, initialize a <a href="/dropella" class="text-amber-400 hover:underline">Dropella</a> zone and command them to blindly toss their shards back in.</div></li>
                        </ol>
                    </div>
                </div>

                <!-- Scenario 06 -->
                <div id="scenario-06" class="scroll-mt-12 group">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-900/40 text-blue-400 px-2 py-1 rounded text-xs font-bold border border-blue-500/20">SCENARIO 06</span>
                        <h2 class="text-2xl font-bold text-gray-200">The Verification Trap</h2>
                    </div>
                    <div class="bg-gray-900/30 border-l-4 border-blue-500 p-6 rounded-r-xl mb-12">
                        <p class="text-sm text-gray-400 mb-6 italic">"Gauging crowd sentiment in oppressive environments without compromising participant anonymity."</p>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <!-- Box Pollella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-blue-500/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-2 text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-blue-400 tracking-wide">Pollella</span>
                            </div>

                            <svg class="w-6 h-6 text-purple-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>

                            <!-- Box Havenella -->
                            <div class="flex flex-col items-center justify-center w-[120px] h-[100px] bg-gray-950/60 border border-gray-800 rounded-xl shadow-lg hover:border-gray-300/30 transition-colors shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-300/10 border border-gray-300/20 flex items-center justify-center mb-2 text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                </div>
                                <span class="text-xs font-bold text-gray-300 tracking-wide">Havenella</span>
                            </div>
                        </div>

                        <ol class="space-y-4 text-gray-300 text-sm">
                            <li class="flex gap-4"><span class="text-blue-500 font-bold">01.</span> <div>Instigate a sensitive poll within <a href="/pollella" class="text-blue-400 hover:underline">Pollella</a> leveraging native double-entry rejection parameters.</div></li>
                            <li class="flex gap-4"><span class="text-blue-500 font-bold">02.</span> <div>Passively distribute the polling URI by embedding it in a volatile <a href="/havenella" class="text-gray-300 hover:underline">Havenella</a> thread. Allow the decentralized algorithm to handle participant verification.</div></li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
