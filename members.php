<?php include 'includes/header.php'; ?>

<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-xl mx-auto mb-10">
        <h1 class="text-3xl font-black text-white">MABC Members</h1>
        
        <input type="text" id="mem-search" oninput="searchMembers()" class="mt-6 w-full bg-slate-900 border border-slate-800 rounded-xl px-5 py-3 text-sm text-white focus:outline-none focus:border-indigo-500" placeholder="Search by name or title...">
        
        <div class="flex flex-wrap justify-center gap-3 mt-6">
            <button onclick="filterType('member', this)" class="filter-btn px-4 py-2 rounded-lg bg-indigo-600 text-white text-xs font-bold transition-all">Members</button>
            <button onclick="filterType('teacher', this)" class="filter-btn px-4 py-2 rounded-lg bg-slate-800 text-slate-400 text-xs font-bold hover:bg-slate-700 transition-all">Teachers</button>
            <button onclick="filterType('advisor', this)" class="filter-btn px-4 py-2 rounded-lg bg-slate-800 text-slate-400 text-xs font-bold hover:bg-slate-700 transition-all">Advisors</button>
        </div>
    </div>

    <!-- Member section -->
    <div id="member-sections" class="space-y-12">
        <div id="sec-committee">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-800 pb-2"><i class="fas fa-crown text-amber-500 mr-2"></i>Committee</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6" id="grid-committee"></div>
        </div>
        <div id="sec-running">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-800 pb-2"><i class="fas fa-user-friends text-indigo-500 mr-2"></i>Running Members</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6" id="grid-running"></div>
        </div>
        <div id="sec-past">
            <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-800 pb-2"><i class="fas fa-history text-slate-500 mr-2"></i>Past Members</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6" id="grid-past"></div>
        </div>
    </div>

    <!-- teacher and Advisor section hidden -->
    <div id="sec-teacher" class="hidden space-y-12">
        <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-800 pb-2"><i class="fas fa-chalkboard-teacher text-emerald-500 mr-2"></i>Teachers</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6" id="grid-teacher"></div>
    </div>
    <div id="sec-advisor" class="hidden space-y-12">
        <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-800 pb-2"><i class="fas fa-user-tie text-amber-500 mr-2"></i>Advisors</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6" id="grid-advisor"></div>
    </div>
</section>

<script>
    async function fetchAndRenderMembers() {
        try {
            const response = await fetch('admin/api.php?table=members');
            let membersData = await response.json();
            
            membersData.sort((a, b) => (a.serial || 99) - (b.serial || 99));
            
            let htmlCommittee = "", htmlRunning = "", htmlPast = "", htmlTeacher = "", htmlAdvisor = "";
            
            membersData.forEach(m => {
                let imgSrc = m.img_url ? m.img_url : 'https://placehold.co/150x150';
                let mType = (m.type || '').toLowerCase().trim();
                
                const template = `
                <a href="profile.php?id=${m.id}" class="m-card block bg-slate-900 p-5 rounded-2xl border border-slate-800 text-center hover:border-indigo-500 hover:shadow-lg hover:shadow-indigo-500/20 hover:-translate-y-1 transition-all duration-300">
                    <img src="${imgSrc}" class="w-20 h-20 rounded-full mx-auto object-cover border border-slate-700" onerror="this.src='https://placehold.co/150x150'">
                    <h3 class="text-sm font-bold text-white mt-3 m-name">${m.name || 'Unknown'}</h3>
                    <p class="text-xs text-indigo-400 mt-1 m-title">${m.title || ''}</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">Year: ${m.year || ''}</p>
                </a>`;

                if(mType === 'committee') htmlCommittee += template;
                else if(mType === 'running') htmlRunning += template;
                else if(mType === 'past') htmlPast += template;
                else if(mType === 'teacher') htmlTeacher += template;
                else if(mType === 'advisor') htmlAdvisor += template;
            });

            document.getElementById('grid-committee').innerHTML = htmlCommittee || '<p class="text-slate-500 text-sm col-span-full text-center">No committee members.</p>';
            document.getElementById('grid-running').innerHTML = htmlRunning || '<p class="text-slate-500 text-sm col-span-full text-center">No running members.</p>';
            document.getElementById('grid-past').innerHTML = htmlPast || '<p class="text-slate-500 text-sm col-span-full text-center">No past members.</p>';
            document.getElementById('grid-teacher').innerHTML = htmlTeacher || '<p class="text-slate-500 text-sm col-span-full text-center">No teachers found.</p>';
            document.getElementById('grid-advisor').innerHTML = htmlAdvisor || '<p class="text-slate-500 text-sm col-span-full text-center">No advisors found.</p>';
            
        } catch (error) { console.error("Error:", error); }
    }

    function filterType(type, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('bg-indigo-600', 'text-white');
            b.classList.add('bg-slate-800', 'text-slate-400');
        });
        btn.classList.add('bg-indigo-600', 'text-white');
        btn.classList.remove('bg-slate-800', 'text-slate-400');

        document.getElementById('member-sections').classList.toggle('hidden', type !== 'member');
        document.getElementById('sec-teacher').classList.toggle('hidden', type !== 'teacher');
        document.getElementById('sec-advisor').classList.toggle('hidden', type !== 'advisor');
    }

    function searchMembers() {
        const v = document.getElementById('mem-search').value.toLowerCase();
        document.querySelectorAll('.m-card').forEach(c => {
            const name = c.querySelector('.m-name').innerText.toLowerCase();
            c.style.display = name.includes(v) ? 'block' : 'none';
        });
    }

    fetchAndRenderMembers();
</script>

<?php include 'includes/footer.php'; ?>