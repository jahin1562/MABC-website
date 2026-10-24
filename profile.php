<?php 
session_start();
include 'includes/header.php'; 
require_once 'db.php'; 

$current_session_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);
$m_id = isset($_GET['id']) ? intval($_GET['id']) : $current_session_id;

if (!$m_id) { 
    header("Location: login.php"); 
    exit(); 
}

$is_own_profile = ( ($current_session_id == $m_id) );
$member = $conn->query("SELECT * FROM members WHERE id = $m_id")->fetch_assoc();

if (!$member) { die("Member not found!"); }

$quiz = $conn->query("SELECT MAX(score) as high_score, COUNT(*) as total FROM quiz_results WHERE member_id = '$m_id'")->fetch_assoc();
?>

<!-- Profile Page -->
<div class="max-w-6xl mx-auto py-10 px-4 mt-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Profile Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-[#0f172a] p-8 rounded-[2rem] border border-[#334155] text-center">
                <img src="<?= $member['img_url'] ?? 'assets/default.png' ?>" class="w-32 h-32 rounded-full mx-auto border-4 border-[#1e293b] object-cover shadow-2xl">
                <h1 class="text-2xl font-bold text-white mt-4"><?= htmlspecialchars($member['name']) ?></h1>
                <p class="text-blue-500 font-medium text-sm uppercase tracking-wider"><?= htmlspecialchars($member['title']) ?></p>
                
                <div class="grid grid-cols-2 gap-3 mt-8 text-left">
                    <?php 
                    $fields = ['Dept' => 'department', 'Year' => 'year', 'Blood' => 'blood_group', 'Religion' => 'religion'];
                    if($is_own_profile) {
                        $fields['Phone'] = 'phone';
                        $fields['Email'] = 'email';
                    }
                    foreach($fields as $label => $key): ?>
                    <div class="bg-[#1e293b] p-3 rounded-xl border border-[#334155]">
                        <p class="text-[9px] text-slate-400 uppercase font-bold"><?= $label ?></p>
                        <p class="text-xs text-slate-200 truncate"><?= $member[$key] ?? 'N/A' ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if($is_own_profile): ?>
                <a href="logout.php" class="mt-8 flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 hover:bg-red-500 hover:text-white transition-all font-bold text-sm">
                    Logout
                </a>
                <?php endif; ?>
            </div>

            <!-- About Section -->
            <div class="bg-[#0f172a] p-6 rounded-[2rem] border border-[#334155]">
                <h3 class="font-bold text-white mb-3">About Me</h3>
                <?php if($is_own_profile): ?>
                    <textarea class="w-full text-sm text-slate-400 bg-transparent border-none focus:ring-0 p-0 resize-none" rows="4" onblur="updateAbout(this.value)"><?= htmlspecialchars($member['about_us'] ?? '') ?></textarea>
                <?php else: ?>
                    <p class="text-sm text-slate-400"><?= htmlspecialchars($member['about_us'] ?? 'No bio available.') ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Stats & Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats Section -->
            <div class="grid grid-cols-1 gap-4">
                <!-- High Score Card -->
                <div class="relative overflow-hidden bg-[#0f172a] border border-[#334155] p-6 rounded-[2rem] shadow-xl group">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <p class="text-slate-400 text-[10px] font-bold tracking-[0.2em] uppercase mb-1">Score</p>
                        <div class="flex items-end gap-2">
                            <h2 class="text-4xl font-black text-white"><?= $quiz['high_score'] ?? 0 ?></h2>
                            <span class="text-slate-500 text-sm font-bold mb-1">/ 5</span>
                        </div>
                    </div>
                    <div class="absolute right-4 top-6 text-indigo-500/20">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Q/A Content -->
            <?php if($is_own_profile): ?>
                <div class="bg-[#0f172a] rounded-[2rem] p-6 border border-[#334155]">
                    <div class="flex gap-8 border-b border-[#334155] mb-6">
                        <button onclick="loadContent('questions')" class="pb-3 font-bold text-white border-b-2 border-blue-500 transition" id="tab-q">Questions</button>
                        <button onclick="loadContent('answers')" class="pb-3 font-bold text-slate-500 hover:text-white transition" id="tab-a">My Answers</button>
                    </div>
                    <div id="content-area" class="space-y-4"></div>
                </div>
            <?php else: ?>
                <div class="p-6 text-center text-slate-500 italic text-sm">
                    Activity section is private.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>

function loadContent(type) {

    document.getElementById('tab-q').className = (type === 'questions') ? 
        'pb-3 font-bold text-white border-b-2 border-blue-500 transition' : 
        'pb-3 font-bold text-slate-500 hover:text-white transition';
        
    document.getElementById('tab-a').className = (type === 'answers') ? 
        'pb-3 font-bold text-white border-b-2 border-blue-500 transition' : 
        'pb-3 font-bold text-slate-500 hover:text-white transition';
    

    const currentMemberId = <?= $m_id ?>;
    
    fetch(`get_profile_data.php?type=${type}&id=${currentMemberId}`)
    .then(res => res.text())
    .then(html => { 
        document.getElementById('content-area').innerHTML = html; 
    })
    .catch(err => console.error("Error loading content:", err));
}


async function updateDatabase() {
    await fetch('api.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            action: 'update_skills',
            member_id: <?= $m_id ?>,
            skills: skills
        })
    });
}

document.addEventListener('DOMContentLoaded', () => {
    loadContent('questions');
});
</script>

<?php include 'includes/footer.php'; ?>