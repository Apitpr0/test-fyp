<?php
include("components/db/db_connection.php");
include("components/header.php");
include("components/navbar.php");

// Check if the current user is an admin
$is_admin = $_SESSION['is_admin'];

// Handle the form submission
if (isset($_POST["update"])) {
    $user_id = $_POST['user_id'];

    // Update the user's is_blocked field to 0
    $result = mysqli_query($connection, "UPDATE users SET is_blocked = 0 WHERE id = $user_id");
}
?>

<div class="container mx-auto py-8">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Pengguna Disekat</h1>
        <a href="dashboard_admin.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Paparan </a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border text-left px-8 py-4">#</th>
                <th class="border text-left px-8 py-4">Nama</th>
                <th class="border text-left px-8 py-4">Nombor IC</th>
                <th class="border text-left px-8 py-4">Disekat</th>
                <th class="border text-left px-8 py-4">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($connection, "SELECT * FROM users WHERE is_blocked = 1");
            while ($info = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo $info['id']; ?></td>
                    <td class="border px-4 py-2"><?php echo $info['name']; ?></td>
                    <td class="border px-4 py-2"><?php echo $info['ic']; ?></td>
                    <td class="border px-4 py-2"><?php echo $info['is_blocked'] ? '<span class="bg-red-500 text-white px-2 rounded">Disekat</span>' : '<span class="bg-green-500 text-white px-2 rounded">Active</span>'; ?></td>
                    <td class="border px-4 py-2">
                        <form method="post" class="inline">
                            <input type="hidden" name="user_id" value="<?php echo $info['id']; ?>">
                            <button type="submit" name="update" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Nyahsekat</button>
                        </form>
                    </td>
                </tr>
        </tbody>
    <?php } ?>
    </table>


</div>

<?php include("components/footer.php"); ?>