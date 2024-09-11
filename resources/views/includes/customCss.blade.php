<style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    body {
        font-family: 'Roboto', sans-serif;
        font-weight: bold;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    a {
        text-decoration: none;
    }

    .profile-card {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 20px;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        border: 4px solid #6e7bff;
        margin: 0 auto;
    }

    .profile-card h5 {
        font-weight: bold;
    }

    .gradient-text {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-gradient {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        border: none;
        color: #ffffff !important;
        transition: background 0.3s ease, color 0.3s ease;
        border-radius: 30px;
        padding: 10px 20px;
    }

    .btn-gradient:hover {
        color: #0c0c0c !important;
    }

    .text {
        color: #3b82f6;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    .text:hover {
        color: #8b5cf6;
        text-decoration: none;
    }

    .navbar-nav .list-group-item {
        background-color: transparent;
        border: none;
        padding: 10px 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    .navbar-nav .list-group-item:last-child {
        border-bottom: none;
    }

    .section-3 {
        background-color: #f8fafc;
        padding: 50px 0;
    }

    h2,
    h3 {
        color: #1e293b;
        font-weight: bold;
    }

    .sidebar .card {
        background-color: #ffffff;
        border-radius: 15px;
    }

    .job_listing_area .card {
        background-color: #ffffff;
        border-radius: 15px;
        transition: transform 0.2s ease;
    }

    .job_listing_area .card:hover {
        transform: translateY(-5px);
    }

    .card-body h3 {
        color: #3b82f6;
        font-weight: bold;
    }

    .card-body p {
        color: #6b7280;
    }

    .btn-secondary {
        background-color: #f8fafc;
        color: #6b7280;
        border: 1px solid #d1d5db;
        font-weight: bold;
        border-radius: 30px;
        padding: 10px 20px;
    }

    .btn-secondary:hover {
        background-color: #e5e7eb;
        color: #1f2937;
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        border: none;
        color: #fff;
        font-weight: bold;
    }
</style>
