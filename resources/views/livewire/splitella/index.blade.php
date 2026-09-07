<div class="max-w-4xl mx-auto px-4 py-8 relative min-h-screen">
    <!-- Background Effects -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-900/40 via-gray-950 to-gray-950"></div>
    <div class="fixed top-[20%] right-[-10%] w-[500px] h-[500px] bg-pink-600/10 rounded-full blur-[120px] animate-pulse pointer-events-none -z-10"></div>

    <!-- Header Section -->
    <div class="text-center mb-12 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-pink-500/10 rounded-full blur-3xl"></div>
        <div class="w-20 h-20 bg-gray-900/50 rounded-3xl border border-gray-800 shadow-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-xl relative z-10 group">
            <svg class="w-10 h-10 text-pink-500 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-pink-500/10 border border-pink-500/20 text-pink-400 text-xs font-bold tracking-widest uppercase mb-4 shadow-[0_0_20px_rgba(236,72,153,0.1)] relative z-10">
            <span class="w-2 h-2 rounded-full bg-pink-400 animate-pulse"></span>
            Splitella
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-400 mb-4 tracking-tight relative z-10">
            SHAMIR'S SECRET SHARING
        </h1>
        <p class="text-gray-400 text-lg font-medium max-w-2xl mx-auto leading-relaxed relative z-10 mb-6">
            Fracture secrets into valueless shards, then reconstruct them via a minimum threshold.
        </p>
        <p class="text-gray-500 text-sm max-w-3xl mx-auto italic font-serif leading-relaxed relative z-10">
            "A highly crucial secret should not be borne intact by a single entity."
        </p>
    </div>

    <!-- Mode Toggle -->
    <div class="flex justify-center mb-8 relative z-10">
        <div class="bg-gray-900/80 p-1.5 rounded-2xl border border-gray-800 inline-flex shadow-inner backdrop-blur-md">
            <button wire:click="setMode('split')" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ $mode === 'split' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/30 shadow-[0_0_15px_rgba(236,72,153,0.15)]' : 'text-gray-500 hover:text-gray-300 transparent border border-transparent' }}">
                Fracture Secret
            </button>
            <button wire:click="setMode('reconstruct')" class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ $mode === 'reconstruct' ? 'bg-pink-500/20 text-pink-400 border border-pink-500/30 shadow-[0_0_15px_rgba(236,72,153,0.15)]' : 'text-gray-500 hover:text-gray-300 transparent border border-transparent' }}">
                Reconstruct Shards
            </button>
        </div>
    </div>

    <!-- Main Container (Client-Side Alpine) -->
    <div class="bg-gray-900/60 backdrop-blur-xl border border-gray-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden animate-fade-in-up"
         x-data="{
             secretToSplit: '',
             totalShares: 5,
             threshold: 3,
             generatedShares: [],
             splitError: '',
             
             inputShares: ['', '', ''],
             reconstructedSecret: '',
             reconstructError: '',
             
             updateThreshold() {
                 if (this.threshold > this.totalShares) this.threshold = this.totalShares;
                 if (this.threshold < 2) this.threshold = 2;
             },
             
             addInputShare() {
                 this.inputShares.push('');
             },
             
             removeInputShare(index) {
                 this.inputShares.splice(index, 1);
             },
             
             splitSecret() {
                 this.splitError = '';
                 this.generatedShares = [];
                 
                 if (!this.secretToSplit) {
                     this.splitError = 'Secret must not be empty.';
                     return;
                 }
                 
                 if (this.threshold > this.totalShares) {
                     this.splitError = 'Minimum threshold must not exceed total shards.';
                     return;
                 }
                 
                 try {
                     // secrets.js requires a hex string. We prepend a magic string to verify reconstruction later.
                     const secretHex = secrets.str2hex('HEXADELLA:' + this.secretToSplit);
                     // secrets.share(secret, numShares, threshold)
                     this.generatedShares = secrets.share(secretHex, parseInt(this.totalShares), parseInt(this.threshold));
                 } catch (e) {
                     this.splitError = 'Failed to fracture secret: ' + e.message;
                 }
             },
             
             reconstructSecret() {
                 this.reconstructError = '';
                 this.reconstructedSecret = '';
                 
                 // Filter empty inputs, trim whitespace, and keep only UNIQUE shares
                 const shares = [...new Set(this.inputShares.map(s => s.trim()).filter(s => s !== ''))];
                 
                 if (shares.length < 2) {
                     this.reconstructError = 'Input a minimum of 2 (unique) shards to recover the secret.';
                     return;
                 }
                 
                 try {
                     const combinedHex = secrets.combine(shares);
                     const reconstructed = secrets.hex2str(combinedHex);
                     
                     // Verify if the reconstruction was truly successful by checking the magic string
                     if (reconstructed && reconstructed.startsWith('HEXADELLA:')) {
                         this.reconstructedSecret = reconstructed.substring(10); // Strip 'HEXADELLA:'
                     } else {
                         throw new Error('Invalid shards.');
                     }
                 } catch (e) {
                     this.reconstructError = 'Failed to recover secret. Incorrect shards, typographical error, or quantity is below the minimum Threshold.';
                 }
             }
         }">
        
        @if($mode === 'split')
            <!-- SPLIT MODE -->
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-300 mb-2">Primary Secret</label>
                    <textarea x-model="secretToSplit" rows="4" class="w-full bg-gray-950 border border-gray-800 rounded-2xl px-5 py-4 text-gray-200 focus:outline-none focus:border-pink-500/50 focus:ring-1 focus:ring-pink-500/50 transition-all font-mono text-sm resize-none" placeholder="Input Seed Phrase, password, or classified text..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">Total Shards (N)</label>
                        <input type="number" x-model="totalShares" @change="updateThreshold" min="2" max="20" class="w-full bg-gray-950 border border-gray-800 rounded-2xl px-5 py-3 text-gray-200 focus:outline-none focus:border-pink-500/50 focus:ring-1 focus:ring-pink-500/50 transition-all text-center text-lg font-bold">
                        <p class="text-xs text-gray-500 mt-2">Quantity of secret shards to generate.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">Minimum Threshold (M)</label>
                        <input type="number" x-model="threshold" @change="updateThreshold" min="2" x-bind:max="totalShares" class="w-full bg-gray-950 border border-gray-800 rounded-2xl px-5 py-3 text-gray-200 focus:outline-none focus:border-pink-500/50 focus:ring-1 focus:ring-pink-500/50 transition-all text-center text-lg font-bold">
                        <p class="text-xs text-gray-500 mt-2">Minimum shards required for future reconstruction.</p>
                    </div>
                </div>

                <div x-show="splitError" style="display: none;" class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-xl text-sm font-medium">
                    <span x-text="splitError"></span>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <button @click="splitSecret" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-[0_0_20px_rgba(236,72,153,0.3)] hover:shadow-[0_0_30px_rgba(236,72,153,0.5)] border border-pink-400/20 uppercase tracking-widest text-sm flex items-center justify-center gap-2 group">
                        Fracture Secret Locally
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>

                <div x-show="generatedShares.length > 0" style="display: none;" class="mt-8 space-y-4 animate-fade-in-up">
                    <h3 class="text-xl font-bold text-gray-100 mb-4">Secret Shards Output</h3>
                    <p class="text-sm text-pink-400 mb-6 bg-pink-500/10 border border-pink-500/20 p-4 rounded-xl">
                        <strong>WARNING:</strong> Store these shards separately (e.g., distribute to <span x-text="totalShares"></span> distinct individuals). A minimum of <strong x-text="threshold"></strong> shards is required to recover your original secret.
                    </p>
                    
                    <template x-for="(share, index) in generatedShares" :key="index">
                        <div class="bg-gray-950 border border-gray-800 rounded-xl p-4 relative group hover:border-pink-500/30 transition-colors">
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Shard <span x-text="index + 1"></span></div>
                            <div class="font-mono text-sm text-gray-300 break-all select-all" x-text="share"></div>
                        </div>
                    </template>
                </div>
            </div>
        @else
            <!-- RECONSTRUCT MODE -->
            <div class="space-y-6">
                <div class="text-center mb-8">
                    <p class="text-gray-400 text-sm">Input the shards in your possession. Note: the number of shards must meet or exceed the minimum Threshold defined during secret creation.</p>
                </div>

                <div class="space-y-4">
                    <template x-for="(share, index) in inputShares" :key="index">
                        <div class="flex items-start gap-3">
                            <div class="flex-1">
                                <textarea x-model="inputShares[index]" rows="2" class="w-full bg-gray-950 border border-gray-800 rounded-2xl px-4 py-3 text-gray-200 focus:outline-none focus:border-pink-500/50 focus:ring-1 focus:ring-pink-500/50 transition-all font-mono text-xs resize-none" :placeholder="'Paste Shard ' + (index + 1) + ' here...'"></textarea>
                            </div>
                            <button x-show="inputShares.length > 2" @click="removeInputShare(index)" class="p-3 bg-gray-900 border border-gray-800 rounded-xl text-gray-500 hover:text-rose-400 hover:bg-rose-500/10 hover:border-rose-500/30 transition-all" title="Remove this input">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </template>
                </div>

                <div class="flex justify-center">
                    <button @click="addInputShare" class="text-xs font-bold text-pink-500 hover:text-pink-400 uppercase tracking-widest flex items-center gap-1 transition-colors bg-pink-500/10 px-4 py-2 rounded-lg border border-pink-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add Shard Field
                    </button>
                </div>

                <div x-show="reconstructError" style="display: none;" class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-xl text-sm font-medium text-center">
                    <span x-text="reconstructError"></span>
                </div>

                <div class="pt-6 border-t border-gray-800">
                    <button @click="reconstructSecret" class="w-full bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-500 hover:to-pink-400 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-[0_0_20px_rgba(236,72,153,0.3)] hover:shadow-[0_0_30px_rgba(236,72,153,0.5)] border border-pink-400/20 uppercase tracking-widest text-sm">
                        Reconstruct & Recover Secret
                    </button>
                </div>

                <div x-show="reconstructedSecret" style="display: none;" class="mt-8 animate-fade-in-up bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6 relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-gray-900 border border-emerald-500/30 px-4 py-1 rounded-full text-xs font-bold text-emerald-400 uppercase tracking-widest flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Secret Recovered
                    </div>
                    <div class="font-mono text-sm text-gray-200 mt-4 break-words whitespace-pre-wrap select-all bg-gray-950 p-4 rounded-xl border border-gray-800/50" x-text="reconstructedSecret"></div>
                </div>
            </div>
        @endif
    </div>

    <!-- Local Cryptographic Library (Air-Gapped Ready) -->
    <script src="/js/secrets.min.js"></script>
</div>
