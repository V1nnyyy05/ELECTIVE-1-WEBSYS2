<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediKeep - Register Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Register New Patient</h2>
            <a href="{{ route('patients.index') }}" class="text-blue-500 hover:underline">← Back to List</a>
        </div>

        <form method="POST" action="{{ route('patients.store') }}">
    @csrf

    <div class="mb-4">
        <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" id="name" required
            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
        <input type="email" name="email" id="email" required placeholder="patient@example.com"
            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Set Password</label>
        <input type="text" name="password" id="password" required placeholder="Minimum 8 characters"
            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
    </div>

    <div class="mb-4">
        <label for="dob" class="block text-sm font-bold text-gray-700 mb-1">Date of Birth</label>
        <input type="date" name="dob" id="dob" required
            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
    </div>

    <div class="mb-6">
        <label for="gender" class="block text-sm font-bold text-gray-700 mb-1">Gender</label>
        <select name="gender" id="gender" required
            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
        Save Patient Record
    </button>
</form>
    </div>
</body>
</html>