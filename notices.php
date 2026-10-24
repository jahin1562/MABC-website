<?php include 'includes/header.php'; ?>

    <section class="py-16 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-white mb-8">Notice Board</h1>
        <div class="space-y-4" id="notice-board-list">
        </div>
    </section>

    <div id="notice-modal" class="hidden fixed inset-0 z-50 bg-[#090d16]/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="bg-slate-900 border border-slate-700 p-6 rounded-2xl max-w-lg w-full relative shadow-2xl overflow-hidden max-h-[90vh] overflow-y-auto">

            
            <span id="modal-notice-date" class="text-xs text-indigo-400 font-bold uppercase tracking-wider"></span>
            
            <img id="modal-notice-img" src="" class="w-full h-auto mt-4 rounded-xl hidden shadow-lg" alt="Notice Image">
            
            <h2 id="modal-notice-title" class="text-xl font-bold text-white mt-4 whitespace-pre-wrap break-words"></h2>
            <button onclick="closeNotice()" class="absolute top-4 right-4 text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700 w-8 h-8 rounded-full flex items-center justify-center transition">
                            <i class="fas fa-times"></i>
            </button>
            <div id="modal-notice-desc" class="text-sm text-slate-300 mt-4 leading-relaxed border-t border-slate-800 pt-4 whitespace-pre-wrap break-words"></div>
        </div>
    </div>

    <script>
        let allNotices = [];

        async function fetchNotices() {
            try {
                const response = await fetch('admin/api.php?table=notices');
                const notices = await response.json();
                
                allNotices = notices;
                let html = "";
                
                if (notices.length === 0) {
                    html = '<p class="text-slate-500 text-center py-10">No notices have been published yet.</p>';
                } else {
                    notices.forEach(n => {
                        let displayDate = n.date || 'Recently';
                        
                        html += `
                        <div class="bg-slate-900 p-5 rounded-xl border border-slate-800/80 cursor-pointer hover:border-indigo-500 hover:-translate-y-1 hover:shadow-lg transition-all duration-300 flex justify-between items-center group" onclick="readNotice(${n.id})">
                            <div class="pr-4">
                                <div class="flex items-center space-x-3 mb-1.5">
                                    ${n.is_urgent == 1 ? '<span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[9px] font-bold px-2 py-0.5 rounded uppercase">Urgent</span>' : ''}
                                    <h3 class="text-base font-bold text-white leading-tight">${n.title || 'Untitled Notice'}</h3>
                                </div>
                                <p class="text-xs text-slate-500"><i class="far fa-calendar mr-1.5"></i>Published: ${displayDate}</p>
                            </div>
                            <div class="bg-slate-800/50 p-3 rounded-full flex-shrink-0 group-hover:bg-indigo-500 transition-colors">
                                <i class="fas fa-arrow-right text-slate-400 group-hover:text-white text-sm"></i>
                            </div>
                        </div>`;
                    });
                }
                
                document.getElementById('notice-board-list').innerHTML = html;
            } catch (error) {
                console.error("Error fetching notices:", error);
                document.getElementById('notice-board-list').innerHTML = '<p class="text-red-400 text-center py-10">Failed to load notices.</p>';
            }
        }

        fetchNotices();

        function readNotice(id) {
            const item = allNotices.find(n => n.id == id);
            if(!item) return;
            
            const imgEl = document.getElementById('modal-notice-img');
            
            document.getElementById('modal-notice-date').innerText = "Published: " + (item.date || 'Recently');
            document.getElementById('modal-notice-title').innerText = item.title;        
            document.getElementById('modal-notice-desc').innerText = item.description || 'No detailed description provided.';
            
            // Image Logic
            if(item.img && item.img.trim() !== "") {
                imgEl.src = item.img;
                imgEl.classList.remove('hidden');
            } else {
                imgEl.classList.add('hidden');
            }
            
            document.getElementById('notice-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        }

        function closeNotice() { 
            document.getElementById('notice-modal').classList.add('hidden'); 
            document.body.style.overflow = 'auto';
        }
    </script>

<?php include 'includes/footer.php'; ?>