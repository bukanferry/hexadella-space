<div class="max-w-3xl mx-auto px-4 py-12 relative min-h-screen"
     x-data="{ 
         pollId: '{{ $poll->uuid }}',
         clientVoted: false,
         init() {
             if (localStorage.getItem('pollella_voted_' + this.pollId)) {
                 this.clientVoted = true;
                 @this.call('markAsVotedFromClient');
             }
             
             // Watch for server side signal to update localStorage
             $watch('$wire.notifyClientVoted', value => {
                 if(value) {
                     localStorage.setItem('pollella_voted_' + this.pollId, 'true');
                     this.clientVoted = true;
                 }
             });
         }
     }">
     
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-blue-900/20 via-gray-950 to-gray-950"></div>

    <div class="bg-gray-900/80 backdrop-blur-md p-8 sm:p-10 rounded-3xl border border-gray-800 shadow-2xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-50 flex flex-col items-end pointer-events-none">
            <svg class="w-24 h-24 text-gray-800 -rotate-12 translate-x-4 -translate-y-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>

        <div class="relative z-10 mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[0.65rem] font-bold tracking-widest uppercase mb-4 shadow-[0_0_15px_rgba(59,130,246,0.1)]">
                <span class="w-1.5 h-1.5 rounded-full {{ $poll->expires_at->isPast() ? 'bg-rose-500' : 'bg-blue-400 animate-pulse' }}"></span>
                {{ $poll->expires_at->isPast() ? 'Poll Terminated' : 'Poll Active' }}
            </div>
            
            <h1 class="text-3xl font-extrabold text-gray-100 mb-2 leading-tight">
                {{ $poll->question }}
            </h1>
            <p class="text-sm text-gray-400">
                Total <span class="text-blue-400 font-bold">{{ number_format($poll->total_votes) }}</span> votes &bull;
                Incinerates at {{ $poll->expires_at->translatedFormat('d F Y H:i') }}
            </p>
        </div>

        <div class="relative z-10">
            @if($errors->has('general'))
                <div class="mb-6 p-4 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-400 text-sm font-medium text-center">
                    {{ $errors->first('general') }}
                </div>
            @endif

            @if($hasVoted || $poll->expires_at->isPast())
                {{-- RESULT VIEW --}}
                <div class="space-y-4 animate-fade-in">
                    @foreach($poll->options as $option)
                        @php
                            $percentage = $poll->total_votes > 0 ? round(($option->votes / $poll->total_votes) * 100) : 0;
                            // Add a subtle glow for the winning option (most votes)
                            $isWinner = $poll->total_votes > 0 && $option->votes === $poll->options->max('votes');
                        @endphp
                        <div class="relative w-full rounded-2xl overflow-hidden bg-gray-950/80 border {{ $isWinner ? 'border-blue-500/40' : 'border-gray-800' }} p-4 transition-all">
                            <!-- Progress Bar Background -->
                            <div class="absolute top-0 left-0 h-full {{ $isWinner ? 'bg-gradient-to-r from-blue-600/30 to-blue-400/10' : 'bg-gray-800/50' }} transition-all duration-1000 ease-out" style="width: {{ $percentage }}%;"></div>
                            
                            <!-- Content -->
                            <div class="relative z-10 flex justify-between items-center gap-4">
                                <span class="font-medium {{ $isWinner ? 'text-blue-100' : 'text-gray-300' }} break-words w-full">{{ $option->text }}</span>
                                <div class="flex flex-col items-end shrink-0">
                                    <span class="text-xl font-bold {{ $isWinner ? 'text-blue-400' : 'text-gray-400' }}">{{ $percentage }}%</span>
                                    <span class="text-[0.65rem] text-gray-500 uppercase tracking-wider">{{ number_format($option->votes) }} votes</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500 bg-gray-950/50 inline-block px-4 py-2 rounded-full border border-gray-800">
                        @if($poll->expires_at->isPast())
                            The voting session has been terminated.
                        @else
                            You have participated. Your identity is absolutely preserved (Zero Logs).
                        @endif
                    </p>
                </div>
            @else
                {{-- VOTING VIEW --}}
                <form wire:submit="vote" class="animate-fade-in">
                    <div class="space-y-3 mb-8">
                        @foreach($poll->options as $option)
                            <label class="relative flex items-center p-5 rounded-2xl border cursor-pointer transition-all duration-200
                                          has-[:checked]:bg-blue-500/10 has-[:checked]:border-blue-500/50 has-[:checked]:shadow-[0_0_20px_rgba(59,130,246,0.15)]
                                          bg-gray-950/50 border-gray-800 hover:border-gray-700 hover:bg-gray-900">
                                <input type="radio" wire:model="selectedOption" value="{{ $option->id }}" class="peer absolute w-full h-full opacity-0 cursor-pointer" name="selectedOption">
                                
                                <div class="w-6 h-6 rounded-full border-2 border-gray-600 flex items-center justify-center mr-4 peer-checked:border-blue-500 peer-checked:bg-transparent transition-all shrink-0">
                                    <div class="w-3 h-3 rounded-full bg-blue-500 scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-gray-300 peer-checked:text-blue-100 font-medium peer-checked:font-bold transition-all text-lg">{{ $option->text }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('selectedOption') <span class="text-rose-400 text-sm mb-4 block font-medium">{{ $message }}</span> @enderror

                    <button type="submit" wire:loading.attr="disabled" class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] flex justify-center items-center gap-2 group border border-blue-400/20 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-wider text-sm">
                        <span wire:loading.remove wire:target="vote">Transmit Anonymous Vote</span>
                        <span wire:loading wire:target="vote" class="animate-pulse">Transmitting...</span>
                        <svg wire:loading.remove wire:target="vote" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            @endif
        </div>
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ route('pollella.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-300 transition-colors">
            &larr; Forge New Poll
        </a>
    </div>
</div>
