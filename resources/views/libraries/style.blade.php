<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@stack('css')

<style>
    /* Global Styles */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --background-color: #f8f9fa;
    --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

body {
    background-color: var(--background-color);
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
}

/* Navbar Styling */
.navbar {
    background-color: white !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem 2rem;
}

.navbar-brand {
    color: var(--primary-color) !important;
    font-weight: 600;
    font-size: 1.5rem;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    margin-top: 2rem;
    overflow: hidden;
}

.card-header {
    background-color: var(--primary-color);
    color: white;
    font-weight: 600;
    padding: 1rem 1.5rem;
    border-bottom: none;
}

.card-body {
    padding: 2rem;
}

/* Form Styling */
.form-control {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    border-color: var(--secondary-color);
}

.form-label {
    font-weight: 500;
    color: var(--primary-color);
}

/* Button Styling */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

.btn-primary:hover {
    background-color: #2980b9;
    border-color: #2980b9;
    transform: translateY(-1px);
}

.btn-link {
    color: var(--secondary-color);
    text-decoration: none;
}

/* Page Title */
h2 {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
    margin-top: 2rem;
}

/* Error Messages */
.invalid-feedback {
    color: var(--accent-color);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Checkbox Styling */
.form-check-input {
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }

    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .col-form-label {
        text-align: left !important;
    }
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card {
    animation: fadeIn 0.5s ease-out;
}
/* Form Input Styling */
.form-control {
    background-color: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    color: #495057;
    transition: all 0.3s ease;
}

.form-control:hover {
    background-color: #ffffff;
    border-color: #cbd3da;
}

.form-control:focus {
    background-color: #ffffff;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
    outline: none;
}

.form-control::placeholder {
    color: #adb5bd;
    font-size: 0.9rem;
}

/* Input Group Styling */
.input-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 2px solid #e9ecef;
    border-right: none;
    color: #6c757d;
}

/* Form Label Enhancement */
.form-label {
    font-weight: 500;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus + .form-label {
    color: var(--secondary-color);
}

/* Required Field Indicator */
.required-field::after {
    content: '*';
    color: var(--accent-color);
    margin-left: 4px;
}

/* Form Group Spacing */
.form-group {
    margin-bottom: 1.5rem;
}

/* Date Input Specific Styling */
input[type="date"].form-control {
    padding: 0.6rem 1rem;
}

/* Number Input Styling */
input[type="number"].form-control {
    -moz-appearance: textfield;
}

input[type="number"].form-control::-webkit-outer-spin-button,
input[type="number"].form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Password Input Styling */
input[type="password"].form-control {
    letter-spacing: 0.1em;
}

/* Disabled Input State */
.form-control:disabled,
.form-control[readonly] {
    background-color: #e9ecef;
    opacity: 0.8;
    cursor: not-allowed;
}

/* Success State */
.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

/* Error State */
.form-control.is-invalid {
    border-color: var(--accent-color);
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

</style>
