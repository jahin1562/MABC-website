<?php 
session_start();
require 'db.php'; 
include 'includes/header.php'; 

// ডিফল্ট ভ্যালু
$userName = "Player";
$dept = "N/A";
$inst = "N/A";

if (isset($_SESSION['member_id'])) {
    $mid = intval($_SESSION['member_id']);
    $res = $conn->query("SELECT name, department, institute FROM members WHERE id = $mid");
    if ($res && $row = $res->fetch_assoc()) {
        $userName = $row['name'];
        $dept = $row['department'] ?? 'N/A';
        $inst = $row['institute'] ?? 'N/A';
    }
} elseif (isset($_SESSION['guest_id'])) {
    $gid = intval($_SESSION['guest_id']);
    $res = $conn->query("SELECT name, department, institute FROM guest_users WHERE id = $gid");
    if ($res && $row = $res->fetch_assoc()) {
        $userName = $row['name'];
        $dept = $row['department'] ?? 'N/A';
        $inst = $row['institute'] ?? 'N/A';
    }
}
?>

<div class="container mx-auto py-10 px-4">
    <!-- Prossess -->
    <div class="max-w-xl mx-auto mb-6 flex justify-between items-center text-white bg-slate-800 p-4 rounded-2xl">
        <span id="q-count" class="font-bold text-lg">Question: 1/5</span>
        <span id="q-score" class="font-bold text-lg text-yellow-400">Score: 0</span>
    </div>

    <!-- Game Board -->
    <div id="game-board" class="max-w-xl mx-auto bg-slate-800 p-8 rounded-3xl border border-slate-700 shadow-2xl">
        <div id="feedback" class="text-6xl text-center mb-4 min-h-[80px]"></div>
        <div id="quiz-content"></div>
    </div>
</div>

<!-- Result Popup -->
<div id="result-popup" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4">
    <div class="bg-slate-800 p-8 rounded-3xl border-2 border-yellow-500 text-center w-full max-w-sm text-white">
        <h2 class="text-2xl font-bold mb-4 text-yellow-400">Game Finished!</h2>
        <div class="grid grid-cols-3 gap-2 mb-6">
            <div class="bg-slate-700 p-2 rounded-lg"><p class="text-[10px] text-slate-400">SCORE</p><p id="p-score" class="font-bold">-</p></div>
            <div class="bg-slate-700 p-2 rounded-lg"><p class="text-[10px] text-slate-400">TIME</p><p id="p-time" class="font-bold">-</p></div>
            <div class="bg-slate-700 p-2 rounded-lg"><p class="text-[10px] text-slate-400">RANK</p><p id="p-rank" class="font-bold">-</p></div>
        </div>
        <div class="flex gap-4 justify-center">
            <button onclick="location.reload()" class="bg-green-600 px-6 py-2 rounded-lg font-bold">Again</button>
            <a href="quiz.php" class="bg-red-600 px-6 py-2 rounded-lg font-bold">Exit</a>
        </div>
    </div>
</div>

<script>
    let questions = [], cur = 0, score = 0, start;

    async function initGame() {
        try {
            const res = await fetch('admin/api.php?table=quiz_questions');
            const data = await res.json();
            if (!data || data.length === 0) { console.error("No questions found"); return; }
            questions = data.sort(() => 0.5 - Math.random()).slice(0, 5);
            start = Date.now();
            render();
        } catch(e) { console.error("Fetch error:", e); }
    }

    function render() {
        if(cur >= 5) return finish();
        const q = questions[cur];
        document.getElementById('q-count').innerText = `Question: ${cur + 1}/5`;
        document.getElementById('q-score').innerText = `Score: ${score}`;
        document.getElementById('quiz-content').innerHTML = `
            ${q.img_url ? `<img src="${q.img_url}" class="w-full h-40 object-cover rounded-xl mb-4">` : ''}
            <h2 class="text-2xl font-bold mb-6 text-white">${q.question}</h2>
            <div class="grid gap-3">
                ${['a','b','c','d'].map(o => `
                    <button onclick="pick('${o}', this)" class="p-4 bg-slate-700 hover:bg-blue-600 rounded-xl text-white font-semibold transition-all">
                        ${q['option_'+o]}
                    </button>
                `).join('')}
            </div>`;
    }

    async function pick(o, btn) {
        const correct = questions[cur].correct_option;
        const feedback = document.getElementById('feedback');
        document.querySelectorAll('button').forEach(b => b.disabled = true);
        if(o === correct) { score++; btn.classList.add('bg-green-600'); feedback.innerHTML = "😊"; } 
        else { btn.classList.add('bg-red-600'); feedback.innerHTML = "😢"; }
        document.getElementById('q-score').innerText = `Score: ${score}`;
        setTimeout(() => { cur++; feedback.innerHTML = ""; render(); }, 1000);
    }

    async function finish() {
    const time = Math.floor((Date.now() - start) / 1000);

const gameData = {
    member_id: <?php echo ($_SESSION['member_id'] ?? $_SESSION['guest_id'] ?? 0); ?>,
    member_name: "<?php echo addslashes($userName); ?>",
    department: "<?php echo addslashes($dept); ?>", 
    institute: "<?php echo addslashes($inst); ?>",   
    score: score,
    time_taken: time
};

    try {
    
        const response = await fetch('admin/api.php?table=quiz_results', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(gameData)
        });

        document.getElementById('result-popup').classList.remove('hidden');
        document.getElementById('p-score').innerText = score + "/5";
        document.getElementById('p-time').innerText = time + "s";

        const resRank = await fetch('admin/api.php?table=quiz_results');
        const allData = await resRank.json();
        
        allData.sort((a,b) => b.score - a.score || a.time_taken - b.time_taken);
        
        const rank = allData.findIndex(r => r.member_id == gameData.member_id) + 1;
        document.getElementById('p-rank').innerText = "#" + rank;

    } catch (err) {
        console.error("Update failed:", err);
    }
}
    initGame();
</script>

<?php

$userName = "Player";
if (isset($_SESSION['member_id'])) {
    $mid = intval($_SESSION['member_id']);
    $res = $conn->query("SELECT name FROM members WHERE id = $mid");
    if ($res && $row = $res->fetch_assoc()) $userName = $row['name'];
} elseif (isset($_SESSION['guest_id'])) {
    $gid = intval($_SESSION['guest_id']);
    $res = $conn->query("SELECT name FROM guest_users WHERE id = $gid");
    if ($res && $row = $res->fetch_assoc()) $userName = $row['name'];
}
?>
<?php include 'includes/footer.php'; ?>