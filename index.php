<?php include 'includes/header.php'; ?>

<!-- Hero Slider -->
<section class="relative h-[400px] md:h-[550px] overflow-hidden bg-slate-950">
    <div id="hero-slider" class="h-full w-full relative flex"></div>
</section>

<!-- Quiz Section -->
<div class="w-full bg-slate-900 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="text-indigo-400 text-xl animate-pulse">
                    <i class="fas fa-gamepad"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm md:text-base">Test Your Skills! 🎮</h3>
                    <p class="text-slate-500 text-[10px] md:text-xs font-medium uppercase tracking-wider">Join the quiz and climb the leaderboard.</p>
                </div>
            </div>
            <a href="quiz.php" class="px-6 py-2.5 bg-white text-slate-900 text-sm font-black rounded-lg hover:bg-indigo-500 hover:text-white transition-all transform hover:scale-105">
                Let's Go
            </a>
        </div>
    </div>
</div>

<!-- Wishes Section -->
<section id="wishes-section" class="py-10 w-full bg-[#0b101c] relative z-10 block">
    <div class="max-w-3xl mx-auto px-4">
        <div id="wishes-fade-container" class="relative min-h-[400px] md:min-h-[300px] w-full mb-6">
             </div>
    </div>
</section>

<!-- Events Section -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 ">
        <h2 class="text-center text-4xl font-bold text-white tracking-tight">Events</h2>
        <a href="events.php" class="mt-4 md:mt-0 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-sm font-semibold text-white transition-all">View All Events</a>
    </div>
    <div class="relative group ">
        <div id="event-slider" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth py-2 cursor-grab select-none"></div>
    </div>
</section>

<!-- Library Section -->
<section class="py-20 bg-slate-900/30 border-y border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-white tracking-tight">Library</h2>
            <a href="books.php" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-sm font-semibold text-white transition-all">View All Books</a>
        </div>
        <div class="relative group">
            <div id="book-slider" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth py-2 cursor-grab select-none"></div>   
        </div>
    </div>
</section>

<!-- Members Section -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-white tracking-tight">Our Core Members</h2>
        <a href="members.php" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-sm font-semibold transition-all">View All Members</a>
    </div>
    <div class="relative">
        <div id="member-slider" class="flex gap-6 overflow-x-auto no-scrollbar scroll-smooth py-2 whitespace-pre-wrap break-words"></div>
    </div>
</section>

<!-- top 3 leaderboardn -->
<section class="py-20 bg-slate-900/30 border-y border-slate-900/50 my-16">
    
    <div class="max-w-4xl mx-auto px-4">
        
        <div class="text-center mb-10">
            <h2 class="text-3xl font-black text-white mb-2">🏆 Top 3 Ranking 🏆</h2>
        </div>

        <!-- Leaderboard List -->
        <div id="top-champions-list" class="space-y-3"></div>

        <div class="mt-8 bg-slate-950/50 border border-slate-800 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-6 transition-all hover:border-indigo-500/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center bg-indigo-500/10 text-indigo-400 rounded-xl text-xl animate-pulse">
                    <i class="fas fa-gamepad"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-base">Take the Challenge! 🎮</h3>
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">Think you have what it takes? Play the quiz and reach the top 3</p>
                </div>
            </div>
            
            <a href="quiz.php" class="w-full md:w-auto px-8 py-3 bg-white text-slate-900 text-sm font-black rounded-xl hover:bg-indigo-500 hover:text-white transition-all text-center transform hover:scale-105 shadow-lg shadow-indigo-500/10">
                Let's Go
            </a>
        </div>

    </div>
</section>

<!-- Q&A Section -->
<section class="py-6 md:py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 p-6 md:p-10 shadow-2xl">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-indigo-600/10 blur-[80px] rounded-full"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-16">
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-white mb-6 leading-tight">
                    Got a Question? <br class="hidden md:block"> 
                    <span class="text-indigo-400">Ask Anything.</span>
                </h2>
                <p class="text-slate-400 text-base md:text-lg mb-8 max-w-xl mx-auto md:mx-0">
                    Connect and collaborate: Post your questions or help others by sharing your answers 
                </p>
                <div class="flex justify-center md:justify-start">
                    <a href="qa.php" class="inline-flex items-center gap-2 px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all hover:scale-105 shadow-lg shadow-indigo-600/20 active:scale-95">
                        Ask a Question
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->

<section class="py-16 bg-slate-900/30 border-y border-slate-900/50 my-16">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-white tracking-tight">Photo Archives</h2>
            <a href="gallery.php" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 border border-slate-800 rounded-xl text-sm font-semibold text-white transition-all">View All</a>
        </div>
        <div class="w-[95%] mx-auto">
            <div id="full-gallery-grid" class="columns-2 md:columns-3 lg:columns-4 gap-4 w-full"></div>
        </div>
        
    </div>
</section>

<!-- Modals -->
<div id="event-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/70 backdrop-blur-md p-4 no-scrollbar">
    <div class="bg-[#0f172a] border border-slate-700 w-full max-w-lg rounded-3xl p-6 relative overflow-y-auto max-h-[90vh] shadow-2xl shadow-black no-scrollbar">
        <button onclick="document.getElementById('event-modal').classList.add('hidden'); document.body.style.overflow='auto'" class="absolute top-4 right-4 bg-slate-800/50 hover:bg-red-500/20 text-slate-400 hover:text-red-400 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"><i class="fas fa-times"></i></button>
        <img id="modal-img" src="" class="w-full h-56 object-cover rounded-2xl mb-5 shadow-lg">
        <h2 id="modal-title" class="text-white text-2xl font-black leading-tight"></h2>
        <div class="mt-4 flex flex-wrap gap-3">
            <div class="bg-indigo-500/10 border border-indigo-500/20 px-3 py-1 rounded-full text-[11px] font-bold text-indigo-400 uppercase tracking-wider">📍 <span id="modal-place"></span></div>
            <div class="bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-400 uppercase tracking-wider">📅 <span id="modal-date"></span></div>
        </div>
        <div class="mt-6 border-t border-slate-800 pt-4"><p class="text-slate-400 text-sm leading-relaxed" id="modal-desc"></p></div>
    </div>
</div>

<div id="book-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-slate-900 border border-slate-700 w-full max-w-lg rounded-3xl p-6 relative no-scrollbar">
        <button onclick="document.getElementById('book-modal').classList.add('hidden'); document.body.style.overflow='auto'" class="absolute top-4 right-4 text-white text-xl"><i class="fas fa-times"></i></button>
        <img id="book-modal-img" src="" class="w-full h-64 object-cover rounded-2xl mb-6">
        <h2 id="book-modal-title" class="text-white text-2xl font-bold"></h2>
        <p id="book-modal-writer" class="text-indigo-400 mt-1"></p>
        <p id="book-modal-desc" class="text-slate-400 mt-4 text-sm"></p>
        <a id="book-modal-link" href="#" target="_blank" class="mt-4 block bg-indigo-600 text-white text-center py-2 rounded-lg text-sm font-bold">Read/Download</a>
    </div>
</div>

<div id="member-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/70 backdrop-blur-md p-4">
    <div class="bg-[#0f172a] border border-slate-700 w-full max-w-lg rounded-[2rem] p-8 relative shadow-2xl shadow-black overflow-y-auto max-h-[90vh]">
        <button onclick="closeMemberModal()" class="absolute top-6 right-6 bg-slate-800/50 hover:bg-red-500/20 text-slate-400 hover:text-red-400 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-300 z-10"><i class="fas fa-times"></i></button>
        <div class="text-center mb-8">
            <div class="relative w-32 h-32 mx-auto mb-5"><div class="absolute inset-0 bg-indigo-500 rounded-full opacity-20 animate-ping"></div><img id="m-modal-img" src="" class="w-full h-full rounded-full object-cover border-4 border-slate-800 shadow-xl"></div>
            <h2 id="m-modal-name" class="text-white text-3xl font-black mb-1"></h2>
            <p id="m-modal-title" class="text-indigo-400 font-bold uppercase tracking-widest text-sm"></p>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 text-center"><p class="text-[10px] uppercase text-slate-500 font-bold mb-1">Department</p><p id="m-modal-dept" class="text-white font-semibold text-sm"></p></div>
            <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 text-center"><p class="text-[10px] uppercase text-slate-500 font-bold mb-1">Blood Group</p><p id="m-modal-blood" class="text-red-400 font-black text-lg"></p></div>
            <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/50 text-center col-span-2"><p class="text-[10px] uppercase text-slate-500 font-bold mb-1">Email</p><p id="m-modal-email" class="text-white font-semibold text-sm break-all"></p></div>
        </div>
        <div class="bg-indigo-900/10 p-5 rounded-2xl border border-indigo-500/10">
            <div class="flex justify-between items-center mb-2"><p class="text-[10px] uppercase text-indigo-400 font-bold tracking-widest">Biography</p><span id="m-modal-year" class="bg-indigo-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold"></span></div>
            <p id="m-modal-about" class="text-slate-300 text-sm leading-relaxed"></p>
        </div>
    </div>
</div>

<div id="gallery-zoom-modal" class="hidden fixed inset-0 z-[100] bg-black/95 flex flex-col items-center justify-center p-4" onclick="closeZoom()">
    <button type="button" onclick="event.stopPropagation(); closeZoom();" class="absolute top-6 right-6 z-[105] text-white text-4xl hover:text-indigo-400 transition-colors p-2"><i class="fas fa-times"></i></button>
    <img id="gz-img" src="" class="max-w-full max-h-[80vh] rounded-xl shadow-2xl">
    <h3 id="gz-title" class="text-white mt-4 text-lg md:text-xl font-semibold text-center tracking-wide"></h3>
</div>

<script>
    const sliders = ['event-slider', 'book-slider', 'member-slider'];
    sliders.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.style.setProperty('-ms-overflow-style', 'none', 'important');
            el.style.setProperty('scrollbar-width', 'none', 'important');
            const style = document.createElement('style');
            style.innerHTML = `#${id}::-webkit-scrollbar { display: none !important; width: 0 !important; height: 0 !important; }`;
            document.head.appendChild(style);
        }
    });


   async function loadTopChampions() {
    try {
        const res = await fetch('admin/api.php?table=quiz_results&t=' + Date.now());
        const allEntries = await res.json();
        if (!Array.isArray(allEntries)) return;

        allEntries.sort((a, b) => b.score - a.score || a.time_taken - b.time_taken);
        const top3 = allEntries.slice(0, 3);
        const container = document.getElementById('top-champions-list');

        container.innerHTML = top3.map((r, i) => {
            const rankColors = ['bg-yellow-400 text-black', 'bg-slate-400 text-white', 'bg-amber-700 text-white'];
            
            return `
            <div class="flex items-center justify-between p-4 bg-slate-900 border border-slate-700 rounded-2xl hover:border-indigo-500 transition-all duration-300">
                <div class="flex items-center gap-6">
                    <div class="w-12 h-12 flex items-center justify-center rounded-xl font-black text-lg ${rankColors[i]} shadow-lg">
                        #${i + 1}
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg">${r.member_name}</h3>
                        <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest">${r.department} • ${r.institute || 'N/A'}</p>
                    </div>
                </div>

                <div class="flex items-center gap-8">
                    <div class="text-center">
                        <p class="text-[9px] text-slate-500 font-bold uppercase">Score</p>
                        <p class="text-white font-black text-md">${r.score}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[9px] text-slate-500 font-bold uppercase">Time</p>
                        <p class="text-emerald-400 font-black text-md">${r.time_taken}s</p>
                    </div>
                </div>
            </div>`;
        }).join('');
    } catch (e) {
        console.error("Error:", e);
    }
}

setInterval(loadTopChampions, 5000);
loadTopChampions();
</script>
<?php include 'includes/footer.php'; ?>