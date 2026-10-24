<?php 
session_start(); 
include 'includes/header.php'; 
include 'db.php';

$isLoggedIn = isset($_SESSION['member_id']) || isset($_SESSION['guest_id']);
$username = '';


if($isLoggedIn) {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $table = isset($_SESSION['member_id']) ? 'members' : 'guest_users';
        $id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : $_SESSION['guest_id'];
        $res_u = $conn->query("SELECT username FROM $table WHERE id = " . intval($id));
        if($row = $res_u->fetch_assoc()) $username = $row['username'];
        $_SESSION['username'] = $username;
    }
}

$dept = $_GET['dept'] ?? '';
$view = $_GET['view'] ?? 'all'; 

// Query Logic
$query = "SELECT * FROM questions WHERE 1=1";
if($dept) $query .= " AND department = '$dept'";

if($view == 'my_q' && $username) {
    $query .= " AND member_name = '$username'";
} elseif($view == 'my_a' && $username) {
    $query = "SELECT DISTINCT q.* FROM questions q JOIN answers a ON q.id = a.question_id WHERE a.member_name = '$username'";
    if($dept) $query .= " AND q.department = '$dept'";
}
$query .= " ORDER BY id DESC";

$res = $conn->query($query);
?>

<section class="py-16 px-4 bg-slate-950 text-white">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl font-black mb-8">Questions & Answers</h2>
        
        <!-- Question From -->
        <?php if($isLoggedIn): ?>
            <div class="bg-indigo-900/20 p-6 rounded-2xl mb-8 border border-indigo-500/30">
                <h3 class="font-bold mb-4">Ask a Question</h3>
                <form action="qa_process.php" method="POST" enctype="multipart/form-data">
                    <select name="department" class="w-full bg-slate-800 p-2 rounded-lg mb-3" required>
                        <option value="">Select Department</option>
                        <option value="Math">Math</option>
                        <option value="Bangla">Bangla</option>
                        <option value="Physics">Physics</option>
                        <option value="ICT">ICT</option>
                        <option value="Fashion">Fashion</option>
                    </select>
                    <textarea name="question" class="w-full bg-slate-800 p-3 rounded-xl mb-3" placeholder="Write your question..." required></textarea>
                    <!--   <input type="file" name="photo_url" class="mb-3 block"> -->
                    <button type="submit" name="submit_question" class="bg-indigo-600 px-6 py-2 rounded-xl font-bold">Post Question</button>
                </form>
            </div>
        <?php else: ?>
            <div class="bg-slate-900 p-4 rounded-xl mb-8 text-center text-slate-400">Please <a href="login.php" class="text-indigo-400 font-bold underline">Login</a> to ask or answer.</div>
        <?php endif; ?>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="?view=all&dept=<?php echo $dept; ?>" class="px-4 py-2 rounded-lg <?php echo $view == 'all' ? 'bg-indigo-600' : 'bg-slate-800'; ?>">All</a>
            <?php if($isLoggedIn): ?>
                <a href="?view=my_q&dept=<?php echo $dept; ?>" class="px-4 py-2 rounded-lg <?php echo $view == 'my_q' ? 'bg-indigo-600' : 'bg-slate-800'; ?>">My Questions</a>
                <a href="?view=my_a&dept=<?php echo $dept; ?>" class="px-4 py-2 rounded-lg <?php echo $view == 'my_a' ? 'bg-indigo-600' : 'bg-slate-800'; ?>">My Answers</a>
            <?php endif; ?>
        </div>

        <select onchange="window.location.href='?view=<?php echo $view; ?>&dept='+this.value" class="bg-slate-800 p-3 rounded-xl mb-6 w-full">
            <option value="">All Departments</option>
            <?php foreach(['Math', 'Bangla', 'Physics', 'ICT', 'Fashion'] as $d): ?>
                <option value="<?php echo $d; ?>" <?php echo $dept == $d ? 'selected' : ''; ?>><?php echo $d; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- List -->
        <?php while($q = $res->fetch_assoc()): ?>
            <div class="bg-slate-900 p-6 rounded-2xl mb-6 border border-slate-800">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs font-bold text-indigo-400 uppercase"><?php echo $q['department']; ?></span>
                    <span class="text-[10px] text-slate-500">ID: <?php echo $q['id']; ?> | <?php echo date('d M, Y', strtotime($q['created_at'])); ?></span>
                </div>
                <h4 class="text-xl font-bold mb-2"><?php echo $q['question']; ?></h4>
                <p class="text-xs text-slate-400 mb-4">Asked by: <b><?php echo $q['member_name']; ?></b></p>
                
                <button onclick="document.getElementById('ans-<?php echo $q['id']; ?>').classList.toggle('hidden')" class="text-emerald-400 font-bold underline text-sm">View/Add Answer</button>

                <div id="ans-<?php echo $q['id']; ?>" class="hidden mt-4 pl-4 border-l-2 border-emerald-900">
                    <?php 
                    $ans_res = $conn->query("SELECT * FROM answers WHERE question_id = ".$q['id']);
                    while($a = $ans_res->fetch_assoc()): ?>
                        <div class="mb-3 bg-slate-950 p-3 rounded-lg">
                            <p class="text-[10px] text-slate-500">Ans ID: <?php echo $a['id']; ?> | By: <?php echo $a['member_name']; ?> | <?php echo date('d M, Y', strtotime($a['created_at'])); ?></p>
                            <p class="text-emerald-300"><?php echo $a['answer']; ?></p>
                        </div>
                    <?php endwhile; ?>
                    
                    <?php if($isLoggedIn): ?>
                        <form action="qa_process.php" method="POST" class="mt-3 flex gap-2">
                            <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
                            <input type="text" name="answer" placeholder="Your answer..." class="bg-slate-800 p-2 rounded w-full" required>
                            <button type="submit" class="bg-emerald-600 px-4 py-2 rounded-lg font-bold">Post</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>