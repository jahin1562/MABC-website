<?php include 'includes/header.php'; ?>
<section class="py-16 px-4">
    <div class="max-w-lg mx-auto bg-slate-900 p-8 rounded-3xl border border-emerald-900">
        <h2 class="text-white text-2xl font-black mb-6">Guest Registration</h2>
        <form action="guest_register_process.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="text" name="name" placeholder="Full Name" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="number" name="age" placeholder="Age" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="file" name="img_url" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="text" name="blood_group" placeholder="Blood Group" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="text" name="institute" placeholder="Institute" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="text" name="department" placeholder="Department" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="text" name="phone" placeholder="Phone" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="email" name="email" placeholder="Email" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="text" name="username" placeholder="Username" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <input type="password" name="password" placeholder="Password" class="w-full bg-slate-800 p-3 rounded-xl text-white" required>
            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-xl font-bold">Register</button>
        </form>
    </div>
</section>
<?php include 'includes/footer.php'; ?>