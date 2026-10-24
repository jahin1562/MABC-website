<?php include 'includes/header.php'; ?>

<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-black text-white">Association Conferences & Meets</h1>
        <div class="mt-6 flex justify-center gap-2" id="catalog-event-filters">
            <button onclick="filterCatalog('all', this)" class="px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 text-white transition-colors">All Events</button>
            <button onclick="filterCatalog('upcoming', this)" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors">Upcoming</button>
            <button onclick="filterCatalog('running', this)" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors">Running</button>
            <button onclick="filterCatalog('past', this)" class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors">Past</button>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-8" id="events-catalog-grid">
        <!-- Events injected -->
    </div>
</section>

<!-- Event Details Modal -->
<div id="event-modal" class="fixed inset-0 z-[100] w-full h-full hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <!-- Event Card -->
    <div class="bg-[#0f172a] border border-slate-700 w-full max-w-2xl max-h-[80vh] overflow-y-auto rounded-[2rem] relative shadow-2xl scrollbar-hide [scrollbar-width:none] [-ms-overflow-style:none]">
        
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-slate-800/80 hover:bg-slate-700 text-white p-2 rounded-full z-20 backdrop-blur transition-all">
            <i class="fas fa-times"></i>
        </button>

        <!-- Image section -->
        <div class="relative">
            <img id="modal-img" src="" class="w-full h-64 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] to-transparent"></div>
        </div>

        <div class="p-6 md:p-8 -mt-10 relative z-10">
            <h2 id="modal-title" class="text-3xl font-black text-white mb-4"></h2>
                
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6 text-xs text-slate-300">
                <div class="flex items-center gap-2 bg-slate-800 p-3 rounded-xl border border-slate-700">
                    <i class="fas fa-calendar-alt text-indigo-500"></i>
                    <span id="modal-date"></span>
                </div>
                <div class="flex items-center gap-2 bg-slate-800 p-3 rounded-xl border border-slate-700">
                    <i class="fas fa-clock text-indigo-500"></i>
                    <span id="modal-time"></span>
                </div>
                <div class="flex items-center gap-2 bg-slate-800 p-3 rounded-xl border border-slate-700">
                    <i class="fas fa-map-marker-alt text-indigo-500"></i>
                    <span id="modal-place"></span>
                </div>
            </div>
                            <div class="grid grid-cols-2 gap-4 text-xs mt-2 mb-6">
                                <div class="bg-indigo-900/10 p-4 rounded-2xl border border-indigo-500/20">
                                    <p class="text-indigo-400 font-bold uppercase tracking-widest mb-1 text-[10px]">Reg. Start</p>
                                    <p class="text-white font-semibold" id="modal-reg-start"></p>
                                </div>
                                <div class="bg-rose-900/10 p-4 rounded-2xl border border-rose-500/20">
                                    <p class="text-rose-400 font-bold uppercase tracking-widest mb-1 text-[10px]">Deadline</p>
                                    <p class="text-white font-semibold" id="modal-reg-end"></p>
                                </div>
                            </div>
            <div class="bg-slate-800/40 p-5 rounded-2xl mb-6 border border-slate-700">
                <p class="text-slate-300 text-sm leading-relaxed" id="modal-description"></p>
            </div>

        </div>
    </div>
</div>

<script>
    function getStatus(ev) {
        const today = new Date();
        today.setHours(0, 0, 0, 0); 
        const regStart = ev.registration_start ? new Date(ev.registration_start) : null;
        const regEnd = ev.registration_deadline ? new Date(ev.registration_deadline) : null;
        if (regStart && regEnd) {
            regStart.setHours(0,0,0,0);
            regEnd.setHours(0,0,0,0);
            if (today < regStart) return "upcoming";
            if (today > regEnd) return "past";
            return "running";
        } 
        const eventDate = new Date(ev.date);
        eventDate.setHours(0,0,0,0);
        if (today < eventDate) return "upcoming";
        if (today > eventDate) return "past";
        return "running";
    }

    async function fetchAndRenderEvents() {
        try {
            const response = await fetch('admin/api.php?table=events');
            const eventsData = await response.json();
            const grid = document.getElementById('events-catalog-grid');
            grid.innerHTML = "";
            
            if (eventsData.length === 0) {
                grid.innerHTML = `<p class="text-slate-500 text-center col-span-full py-10">No events found.</p>`;
                return;
            }

            eventsData.forEach(ev => {
                const status = getStatus(ev);
                const color = status === 'upcoming' ? 'indigo' : status === 'running' ? 'emerald' : 'rose';
                const imgSrc = ev.img_url ? ev.img_url : 'https://placehold.co/800x400';
                
                const card = document.createElement('div');
                card.className = `cat-card bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden cursor-pointer hover:-translate-y-1 hover:shadow-lg hover:shadow-${color}-500/10 hover:border-${color}-500/30 transition-all duration-300`;
                card.setAttribute('data-status', status);
                card.onclick = () => openModal(ev);

                card.innerHTML = `
                    <img src="${imgSrc}" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/800x400'">
                    <div class="p-6">
                        <span class="px-2.5 py-1 text-[10px] font-extrabold uppercase rounded bg-${color}-500/10 text-${color}-400 border border-${color}-500/20">${status}</span>
                        <h3 class="text-lg font-bold text-white mt-3 truncate">${ev.title || 'Untitled Event'}</h3>
                        <p class="text-xs text-slate-400 mt-2 truncate"><i class="fas fa-map-marker-alt text-indigo-500/70 mr-2"></i>${ev.place || 'TBA'}</p>
                    </div>`;
                grid.appendChild(card);
            });
        } catch (error) { console.error("Error:", error); }
    }

    function openModal(ev) {
        document.getElementById('modal-img').src = ev.img_url || 'https://placehold.co/800x400';
        document.getElementById('modal-title').innerText = ev.title || 'Untitled Event';
        document.getElementById('modal-date').innerText = ev.date || 'N/A';
        document.getElementById('modal-time').innerText = ev.time || 'N/A';
        document.getElementById('modal-place').innerText = ev.place || 'TBA';
        document.getElementById('modal-description').innerText = ev.description || 'No description available.';
        document.getElementById('modal-reg-start').innerText = ev.registration_start || 'N/A';
        document.getElementById('modal-reg-end').innerText = ev.registration_deadline || 'N/A';
        
        const modal = document.getElementById('event-modal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('event-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function filterCatalog(status, btnElement) {
        document.querySelectorAll('.cat-card').forEach(c => {
            c.style.display = (status === 'all' || c.getAttribute('data-status') === status) ? 'block' : 'none';
        });
        document.querySelectorAll('#catalog-event-filters button').forEach(b => {
            b.className = "px-4 py-2 rounded-xl text-xs font-bold bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors";
        });
        btnElement.className = "px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 text-white transition-colors";
    }

    fetchAndRenderEvents();
</script>

<?php include 'includes/footer.php'; ?>