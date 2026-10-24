<?php
require 'db.php';
$m_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = $_GET['type'] ?? 'questions';


$res_m = $conn->query("SELECT username FROM members WHERE id = $m_id");
$member = $res_m->fetch_assoc();
$username = $member['username'] ?? '';

if (!$username) {
    echo "<p class='text-slate-500 text-sm p-4'>User not found or no activity yet.</p>";
    exit;
}

if ($type == 'questions') {

    $res = $conn->query("SELECT * FROM questions WHERE member_name = '$username' ORDER BY id DESC");
    
    if($res && $res->num_rows > 0) {
        while($q = $res->fetch_assoc()) {
            echo "<div class='bg-[#0f172a] p-6 rounded-2xl border border-[#334155] mb-4'>";
            echo "<h3 class='font-bold text-lg text-white'>".htmlspecialchars($q['question'])."</h3>";
            
            $ans = $conn->query("SELECT * FROM answers WHERE question_id = ".$q['id']);
            while($a = $ans->fetch_assoc()) {
                echo "<div class='mt-4 pl-4 border-l-4 border-emerald-500 bg-[#1e293b] p-3 text-sm text-emerald-300'>
                        <span class='text-[10px] text-slate-500 block'>".htmlspecialchars($a['member_name'])."</span>
                        ".htmlspecialchars($a['answer'])."
                      </div>";
            }
            echo "</div>";
        }
    } else {
        echo "<p class='text-slate-500 text-sm p-4'>No questions asked yet.</p>";
    }
} else {
    
    $res = $conn->query("SELECT a.*, q.question FROM answers a JOIN questions q ON a.question_id = q.id WHERE a.member_name = '$username' ORDER BY a.id DESC");
    
    if($res && $res->num_rows > 0) {
        while($a = $res->fetch_assoc()) {
            echo "<div class='bg-[#0f172a] p-6 rounded-2xl border border-[#334155] mb-4'>";
            echo "<h4 class='text-white font-bold text-md mb-3'>Question: ".htmlspecialchars($a['question'])."</h4>";
            echo "<div class='pl-4 border-l-4 border-emerald-500 bg-[#1e293b] p-3 text-sm text-emerald-300'>";
            echo "<b>Answer:</b> ".htmlspecialchars($a['answer']);
            echo "</div></div>";
        }
    } else {
        echo "<p class='text-slate-500 text-sm p-4'>No answers provided yet.</p>";
    }
}
?>