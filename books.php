<?php include 'includes/header.php'; ?>

<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <h1 class="text-4xl font-black text-white mb-6">Digital Library</h1>
        
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4">
            <input type="text" id="lib-search" oninput="filterLibrary()" class="flex-grow bg-slate-900 border border-slate-700 rounded-xl px-5 py-3 text-sm text-white focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Search by title or author...">
            
            <select id="type-filter" onchange="filterLibrary()" class="bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white outline-none">
                <option value="all">All Types</option>
                <option value="book">Books</option>
                <option value="question">Questions</option>
            </select>

            <select id="sub-filter" onchange="filterLibrary()" class="bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white outline-none">
                <option value="all">All Subjects</option>
                <option value="bangla">Bangla</option>
                <option value="english">English</option>
                <option value="math">Math</option>
                <option value="ict">ICT</option>
                <option value="general">General</option>
            </select>

            <!-- নতুন Year Filter -->
            <select id="year-filter" onchange="filterLibrary()" class="hidden bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white outline-none">
                <option value="all">All Years</option>
                <option value="1st">1st Year</option>
                <option value="2nd">2nd Year</option>
                <option value="3rd">3rd Year</option>
                <option value="4th">4th Year</option>
            </select>
        </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6" id="library-grid">
        <p class="text-slate-500 text-center col-span-full py-10">Loading library...</p>
    </div>
</section>

<!-- Modern Modal -->
<div id="book-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/70 backdrop-blur-xl p-4">
    <div class="bg-slate-900 border border-slate-700 w-full max-w-lg rounded-[2.5rem] p-8 relative shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden no-scrollbar">
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-indigo-500/10 to-transparent"></div>

        <button onclick="closeLibBookModal()" class="absolute top-6 right-6 bg-slate-800 hover:bg-red-500/20 text-slate-400 hover:text-red-400 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 z-10">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="relative flex flex-col items-center text-center">
            <div class="relative w-36 h-52 mb-6 shadow-2xl rounded-xl overflow-hidden border border-slate-700">
                <img id="modal-book-img" src="" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/400x600'">
            </div>
            
            <h2 id="modal-book-name" class="text-2xl font-black text-white leading-tight mb-1"></h2>
            <p id="modal-book-writer" class="text-indigo-400 font-bold uppercase tracking-widest text-[11px] mb-6"></p>

            <div class="w-full bg-slate-800/50 p-5 rounded-2xl border border-slate-700/50 mb-8">
                <p class="text-[10px] uppercase text-slate-500 font-bold mb-2 tracking-widest">About this book</p>
                <p id="modal-book-desc" class="text-slate-300 text-sm leading-relaxed text-left"></p>
            </div>
            
            <a id="modal-book-link" href="#" target="_blank" class="group w-full py-4 bg-white text-slate-900 font-black rounded-2xl flex items-center justify-center gap-2 hover:bg-indigo-500 hover:text-white transition-all duration-300">
                <span>Go For Download</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

<script>
    let allBooks = [];

    async function loadBooks() {
        try {
            const res = await fetch('admin/api.php?table=books');
            allBooks = await res.json();
            renderLibrary(allBooks);
        } catch (e) { console.error("Error:", e); }
    }

    function renderLibrary(books) {
        const grid = document.getElementById('library-grid');
        grid.innerHTML = "";
        books.forEach(bk => {
            const card = document.createElement('div');
            card.className = "book-item group bg-slate-900 rounded-2xl border border-slate-800 p-4 cursor-pointer hover:border-indigo-500 transition-all overflow-hidden";
            card.dataset.type = bk.type || 'book';
            card.dataset.sub = bk.subject || 'general';
            card.dataset.year = bk.year || 'none'; // নতুন ডাটা সেট
            
            card.onclick = () => openLibBookModal(bk);
            card.innerHTML = `
                <div class="relative overflow-hidden rounded-xl mb-4">
                    <img src="${bk.img_url || 'https://placehold.co/400x600'}" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-500" onerror="this.src='https://placehold.co/400x600'">
                    <span class="absolute top-2 left-2 bg-black/60 backdrop-blur px-2 py-1 rounded-lg text-[10px] font-bold text-white uppercase">${bk.type || 'book'}</span>
                </div>
                <h3 class="text-white font-bold text-sm truncate b-name">${bk.name}</h3>
                <p class="text-indigo-400 text-[11px] font-semibold mt-1 b-writer">${bk.writer}</p>
            `;
            grid.appendChild(card);
        });
    }

    function filterLibrary() {
        const q = document.getElementById('lib-search').value.toLowerCase();
        const type = document.getElementById('type-filter').value;
        const sub = document.getElementById('sub-filter').value;
        const year = document.getElementById('year-filter').value;

        // বছর ফিল্টার শুধুমাত্র প্রশ্ন হলে দেখাবে
        const yearFilter = document.getElementById('year-filter');
        yearFilter.classList.toggle('hidden', type !== 'question');

        document.querySelectorAll('.book-item').forEach(card => {
            const name = card.querySelector('.b-name').innerText.toLowerCase();
            const writer = card.querySelector('.b-writer').innerText.toLowerCase();
            
            const matchesSearch = name.includes(q) || writer.includes(q);
            const matchesType = (type === 'all' || card.dataset.type === type);
            const matchesSub = (sub === 'all' || card.dataset.sub === sub);
            const matchesYear = (type !== 'question' || year === 'all' || card.dataset.year === year);

            card.style.display = (matchesSearch && matchesType && matchesSub && matchesYear) ? 'block' : 'none';
        });
    }

    function openLibBookModal(bk) {
        document.getElementById('modal-book-img').src = bk.img_url;
        document.getElementById('modal-book-name').innerText = bk.name;
        document.getElementById('modal-book-writer').innerText = "By " + bk.writer;
        document.getElementById('modal-book-desc').innerText = bk.description;
        document.getElementById('modal-book-link').href = bk.link;
        document.getElementById('book-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLibBookModal() {
        document.getElementById('book-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    loadBooks();
</script>

<?php include 'includes/footer.php'; ?>