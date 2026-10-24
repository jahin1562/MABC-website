<?php session_start(); include 'includes/header.php'; ?>

<section class="min-h-[80vh] flex items-center justify-center py-16 px-4">
    <div class="w-full max-w-sm">
            <?php 
            if (isset($_SESSION['error'])) {
                echo '<div class="w-full max-w-sm mx-auto mb-4 p-4 bg-red-600/20 border border-red-500 text-red-500 rounded-xl text-center font-bold">';
                echo $_SESSION['error'];
                echo '</div>';
                unset($_SESSION['error']);
            }
            ?>
        <!-- Member Login Form -->
        <div id="member-form" class="bg-slate-900 border border-slate-700 p-8 rounded-3xl shadow-2xl">
            <h2 class="text-white text-2xl font-black text-center mb-6">Member Login</h2>
            <form action="auth_login.php" method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Username" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white" required>
                <input type="password" name="password" placeholder="Password" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white" required>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition">Login</button>
            </form>
            <p class="text-slate-500 text-sm text-center mt-6">
                Guest? <button onclick="toggleForms()" class="text-emerald-400 font-bold hover:underline">Login here</button>
            </p>
        </div>

        <!-- Guest Login Form -->
        <div id="guest-form" class="hidden bg-slate-900 border border-emerald-900/50 p-8 rounded-3xl shadow-2xl">
            <h2 class="text-white text-2xl font-black text-center mb-6">Guest Login</h2>
            <form action="guest_auth.php" method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Username" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white" required>
                <input type="password" name="password" placeholder="Password" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white" required>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl transition">Login</button>
            </form>
            <p class="text-slate-500 text-sm text-center mt-6">
                No account? <a href="register_guest.php" class="text-emerald-400 font-bold hover:underline">Register now</a>
            </p>
            <button onclick="toggleForms()" class="w-full mt-4 text-slate-500 text-sm hover:text-white underline">Back to Member Login</button>
        </div>
    </div>
</section>

<script>
function toggleForms() {
    document.getElementById('member-form').classList.toggle('hidden');
    document.getElementById('guest-form').classList.toggle('hidden');
}
</script>

<?php include 'includes/footer.php'; ?>