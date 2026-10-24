<?php 
session_start();
include 'includes/header.php'; 
$isLoggedIn = isset($_SESSION['member_id']) || isset($_SESSION['guest_id']);
?>

<div class="container mx-auto py-10 px-4 text-center">
    <h1 class="text-5xl font-extrabold text-yellow-500 mb-10">Game Zone</h1>
    
    <!-- Play Button -->
    <?php if($isLoggedIn): ?>
        <a href="game.php" class="bg-blue-600 hover:bg-blue-700 text-white px-12 py-5 rounded-full text-2xl font-bold inline-block">PLAY GAME</a>
    <?php else: ?>
        <p class="text-xl text-red-400 font-bold">Please login to play!</p>
    <?php endif; ?>

    <!-- Leaderboard -->
    <div class="mt-16 bg-slate-900 p-8 rounded-3xl border border-slate-700">
    <h2 class="text-2xl font-bold text-white mb-6">🏆 Leaderboard</h2>
    <table class="w-full text-left text-white">
        <thead>
            <tr class="text-slate-400 border-b border-slate-700">
                <th class="p-3">Rank</th>
                <th class="p-3">Player</th>
                <th class="p-3">Score</th>
                <th class="p-3">Time</th>
            </tr>
        </thead>
        <tbody id="leaderboard-body"></tbody>
    </table>
    </div>
</div>

<script>
async function loadLeaderboard() {
    try {
        const res = await fetch('admin/api.php?table=quiz_results&t=' + Date.now());
        const allEntries = await res.json();

        if (!Array.isArray(allEntries)) return;

        allEntries.sort((a,b) => b.score - a.score || a.time_taken - b.time_taken);

        document.getElementById('leaderboard-body').innerHTML = allEntries.slice(0, 10).map((r, i) => `
            <tr class="border-b border-slate-800 hover:bg-slate-800/50 transition-all">
                <td class="p-3 font-bold text-yellow-400">#${i+1}</td>
                <td class="p-3">
                    <div class="font-bold text-white">${r.member_name}</div>
                    <div class="text-[10px] text-slate-500">${r.department || 'N/A'} • ${r.institute || 'N/A'}</div>
                </td>
                <td class="p-3 font-bold text-blue-400">${r.score}</td>
                <td class="p-3 text-green-400">${r.time_taken}s</td>
            </tr>`).join('');
    } catch (e) {
        console.error("Error loading leaderboard:", e);
    }
  }

  setInterval(loadLeaderboard, 5000);
  loadLeaderboard();
</script>
<?php include 'includes/footer.php'; ?>