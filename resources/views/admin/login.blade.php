<style>
    /* Center the form on the page */
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
    }

    /* Style the form container */
    .login-form {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Style the input fields */
    .login-form input[type="text"],
    .login-form input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    /* Style the button */
    .login-form button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: #ffffff;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Change button color on hover */
    .login-form button[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Style the placeholder text */
    ::placeholder {
        color: #888;
    }
</style>

<form action="{{ route('admin.login.submit') }}" method="POST" class="login-form">
    @csrf
    <input type="text" name="name" placeholder="User Name" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
