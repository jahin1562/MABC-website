<?php include 'includes/header.php'; ?>

<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-black text-white text-center mb-12">Event Photo Archives</h1>
    
    <div class="flex justify-center">
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 w-full" id="full-gallery-grid">
            <!-- Gallery  -->
        </div>
    </div>
</section>

<!-- Zoom Modal -->
<div id="gallery-zoom-modal" class="hidden fixed inset-0 z-[100] bg-black/95 flex flex-col items-center justify-center p-4" onclick="closeZoom()">
    
    <button type="button" onclick="event.stopPropagation(); closeZoom();" class="absolute top-6 right-6 z-[105] text-white text-4xl hover:text-indigo-400 transition-colors p-2">
        <i class="fas fa-times"></i>
    </button>
    
    <img id="gz-img" src="" class="max-w-full max-h-[80vh] rounded-xl shadow-2xl">
    <h3 id="gz-title" class="text-white mt-4 text-lg md:text-xl font-semibold text-center tracking-wide"></h3>
</div>

<script>
async function loadGallery() {
        try {
            const response = await fetch('admin/api.php?table=gallery&_t=' + Date.now());
            const rawGalleryData = await response.json(); 
        
            console.log("Raw Data:", rawGalleryData); 
            
            let h = "";
            rawGalleryData.forEach(g => {
                h += `
                <div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden cursor-pointer group mb-4 break-inside-avoid shadow-lg transition-transform hover:shadow-indigo-500/20" 
                     onclick="openZoom('${g.img_url || ''}', '${g.title || ''}')">
                    <div class="overflow-hidden">
                        <img src="${g.img_url || ''}" class="w-full h-auto transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-3">
                        <p class="text-white text-sm font-semibold truncate">${g.title || ''}</p>
                    </div>
                </div>`;
            });
            
            document.getElementById('full-gallery-grid').innerHTML = h;
            
        } catch (error) {
            console.error("Error loading gallery:", error);
        }
    }

    function openZoom(url, title) { 
        document.getElementById('gz-img').src = url; 
        document.getElementById('gz-title').innerText = title; 
        document.getElementById('gallery-zoom-modal').classList.remove('hidden'); 
        document.body.style.overflow = 'hidden'; 
    }
    
    function closeZoom() { 
        document.getElementById('gallery-zoom-modal').classList.add('hidden'); 
        document.body.style.overflow = 'auto'; 
    }
    
    loadGallery();
</script>

<?php include 'includes/footer.php'; ?>