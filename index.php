<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAW - Pemilihan Siswa Berprestasi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    /* Color Variables - Adjusted for a darker, more purple-blue theme with bright accents */
    :root {
      --primary-dark: #0A0A2A; /* Very dark blue/purple */
      --secondary-dark: #1F0A44; /* Darker purple */
      --accent-blue: #00CFFF; /* Bright light blue for accents */
      --accent-purple: #8A2BE2; /* A vibrant purple for highlights */
      --text-light: #E0E0E0; /* Light gray for general text */
      --text-lighter: #FFFFFF; /* Pure white for headings/important text */
      --shadow-dark: 0 8px 16px rgba(0, 0, 0, 0.4); /* Darker, more pronounced shadow */
      --border-color: rgba(255, 255, 255, 0.1); /* Subtle white border */
      --gradient-background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif; /* Changed to Poppins as primary */
      background: var(--gradient-background);
      color: var(--text-light);
      line-height: 1.6;
      min-height: 100vh;
      padding-bottom: 40px;
      overflow-x: hidden; /* Prevent horizontal scroll from curve */
      position: relative;
    }

    /* Background animated curves/elements - More prominent and stylized */
    body::before, body::after, .bg-element-1, .bg-element-2 {
      content: '';
      position: absolute;
      z-index: -1;
      border-radius: 50%;
      opacity: 0.2; /* Slightly more visible */
      filter: blur(120px); /* Increased blur */
    }

    body::before { /* Top-left large circle */
      top: -150px;
      left: -150px;
      width: 500px;
      height: 500px;
      background: var(--accent-blue);
      animation: floatEffect 10s ease-in-out infinite alternate;
    }

    body::after { /* Bottom-right large circle */
      bottom: -150px;
      right: -150px;
      width: 550px;
      height: 550px;
      background: var(--accent-purple);
      animation: floatEffect 12s ease-in-out infinite alternate reverse;
    }

    .bg-element-1 { /* Mid-left smaller circle */
      top: 20%;
      left: -80px;
      width: 250px;
      height: 250px;
      background: rgba(0, 207, 255, 0.3);
      filter: blur(80px);
      animation: floatEffect 8s ease-in-out infinite;
    }

    .bg-element-2 { /* Mid-right smaller circle */
      bottom: 25%;
      right: -100px;
      width: 300px;
      height: 300px;
      background: rgba(138, 43, 226, 0.3);
      filter: blur(90px);
      animation: floatEffect 9s ease-in-out infinite reverse;
    }

    @keyframes floatEffect {
      0% { transform: translate(0, 0); }
      50% { transform: translate(20px, 20px); }
      100% { transform: translate(0, 0); }
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 2; /* Ensure content is above background elements */
    }

    header {
      background: rgba(0, 0, 0, 0.2); /* Slightly transparent dark header */
      backdrop-filter: blur(10px); /* Frosted glass effect for header */
      color: var(--text-lighter);
      padding: 15px 0;
      box-shadow: var(--shadow-dark);
      position: sticky; /* Sticky header */
      top: 0;
      z-index: 1000;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .logo-title-container {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo {
      width: 50px; /* Slightly smaller logo */
      height: 50px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 15px rgba(0, 207, 255, 0.3); /* Glowing effect */
      transition: all 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.1);
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 20px var(--accent-blue);
    }

    .logo i {
      font-size: 24px; /* Icon size */
      color: var(--accent-blue);
    }

    .site-title { /* Added a class for the main site title next to logo */
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-lighter);
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    nav {
      background: transparent;
      box-shadow: none;
      margin: 0;
      padding: 0;
    }

    .nav-links {
      display: flex;
      justify-content: flex-end;
      list-style: none;
      flex-wrap: wrap;
      align-items: center;
    }

    .nav-links li {
      margin: 0 12px; /* Adjusted spacing */
    }

    .nav-links a {
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      color: var(--text-light);
      font-weight: 500;
      border-radius: 8px; /* More pronounced rounded corners */
      transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
      position: relative;
      overflow: hidden; /* For button hover effect */
    }

    /* Underline hover effect */
    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: var(--accent-blue);
      transform: scaleX(0);
      transform-origin: bottom right;
      transition: transform 0.3s ease-out;
    }

    .nav-links a:hover::after {
      transform: scaleX(1);
      transform-origin: bottom left;
    }

    .nav-links a:hover {
      color: var(--accent-blue);
      transform: translateY(-3px); /* More noticeable lift */
    }

    .nav-links a.active {
      color: var(--accent-blue);
      border-bottom: 2px solid var(--accent-blue); /* Underline active link */
      transform: translateY(-3px);
    }

    .nav-links a.active::after {
      transform: scaleX(1); /* Ensure active link is always underlined */
      transform-origin: bottom left;
    }

    .nav-links i {
      margin-right: 8px;
    }

    .btn-logout {
      background: var(--accent-blue);
      color: var(--primary-dark); /* Darker text for contrast */
      border: none;
      border-radius: 30px;
      padding: 10px 25px; /* Slightly larger padding */
      cursor: pointer;
      font-weight: 600; /* Bolder text */
      transition: all 0.3s ease;
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
      margin-left: 25px; /* More space */
      box-shadow: 0 5px 15px rgba(0, 207, 255, 0.3); /* Subtle glow */
    }

    .btn-logout:hover {
      background: #00EFFF; /* Brighter on hover */
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 207, 255, 0.4);
    }

    main {
      padding: 40px 0;
      position: relative;
    }

    .hero-section {
      display: flex; /* Use flexbox for layout */
      align-items: center;
      justify-content: space-between;
      padding: 80px 20px;
      margin-bottom: 40px;
      position: relative;
      overflow: hidden; /* Hide overflowing elements */
    }

    .hero-content {
      flex: 1; /* Takes up available space */
      text-align: left; /* Align text to the left */
      padding-right: 50px; /* Space from illustration */
    }

    .hero-section h1 {
      font-size: 3.8rem; /* Larger heading */
      margin-bottom: 15px;
      font-weight: 700;
      color: var(--text-lighter);
      line-height: 1.2;
    }

    .hero-section h1 span {
      color: var(--accent-blue); /* Highlight SAW */
      text-shadow: 0 0 15px rgba(0, 207, 255, 0.5); /* Soft glow */
    }

    .hero-section .subtitle {
      font-size: 1.6rem; /* Larger subtitle */
      margin-bottom: 40px;
      max-width: 700px;
      opacity: 0.9;
      line-height: 1.4;
    }

    .illustration-container {
      flex-shrink: 0; /* Don't shrink */
      width: 500px; /* Fixed width for illustration */
      height: 400px; /* Fixed height for illustration */
      background: url('Screen%20Shot%202025-06-17%20at%201.50.47%20AM.jpg') no-repeat center center / contain; /* Your image here */
      position: relative;
      animation: fadeInZoom 1.5s ease-out; /* Animation for illustration */
    }

    @keyframes fadeInZoom {
      from { opacity: 0; transform: scale(0.8); }
      to { opacity: 1; transform: scale(1); }
    }

    .team-info {
      display: none; /* Keep hidden as requested */
    }

    .section {
      background: rgba(255, 255, 255, 0.08); /* Slightly more opaque for sections */
      border-radius: 20px; /* More rounded */
      box-shadow: var(--shadow-dark);
      padding: 35px; /* More padding */
      margin-bottom: 30px;
      transition: transform 0.4s ease, background 0.4s ease, box-shadow 0.4s ease;
      backdrop-filter: blur(8px); /* Stronger frosted glass */
      border: 1px solid rgba(255, 255, 255, 0.15); /* More visible border */
    }

    .section:hover {
      transform: translateY(-8px); /* More noticeable lift on hover */
      background: rgba(255, 255, 255, 0.12); /* More opaque on hover */
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5); /* Stronger shadow */
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px; /* More space */
      padding-bottom: 20px;
      border-bottom: 2px solid var(--accent-blue);
    }

    h2 {
      font-size: 2.2rem; /* Larger section titles */
      color: var(--text-lighter);
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 600;
    }

    h2 i {
      color: var(--accent-blue);
      font-size: 1.8rem; /* Larger icon */
    }

    .btn {
      display: inline-flex; /* Use flex for icon and text alignment */
      align-items: center;
      gap: 8px; /* Space between icon and text */
      padding: 12px 25px; /* Larger padding */
      background: var(--accent-purple); /* Changed to purple for distinction */
      color: white;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
      box-shadow: 0 5px 15px rgba(138, 43, 226, 0.3);
    }

    .btn:hover {
      background: #9A30E6; /* Brighter purple on hover */
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(138, 43, 226, 0.4);
    }

    .btn-action-group {
      display: flex;
      gap: 8px; /* Space between buttons in action column */
    }

    .btn-success {
      background: #27ae60;
      box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
    }
    .btn-success:hover {
      background: #2ecc71;
      box-shadow: 0 8px 20px rgba(39, 174, 96, 0.4);
    }

    .btn-warning {
      background: #f39c12;
      box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    }
    .btn-warning:hover {
      background: #f1c40f;
      box-shadow: 0 8px 20px rgba(243, 156, 18, 0.4);
    }

    .btn-danger {
      background: #e74c3c;
      box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }
    .btn-danger:hover {
      background: #c0392b;
      box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Larger min width */
      gap: 20px; /* More space */
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: 500;
      color: var(--text-light);
      font-size: 1.1rem;
    }

    input, select {
      width: 100%;
      padding: 14px 18px; /* Larger input fields */
      border: 1px solid rgba(255, 255, 255, 0.2); /* More visible border */
      background: rgba(255, 255, 255, 0.03); /* Very subtle background */
      color: var(--text-lighter);
      border-radius: 10px; /* More rounded */
      font-family: 'Roboto', sans-serif;
      font-size: 1.05rem;
      transition: border 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
    }

    input:focus, select:focus {
      outline: none;
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 4px rgba(0, 207, 255, 0.3); /* Stronger glow */
      background: rgba(255, 255, 255, 0.05);
    }

    /* Table Styling */
    table {
      width: 100%;
      border-collapse: separate; /* Use separate for border-radius on cells */
      border-spacing: 0;
      margin-top: 25px;
      box-shadow: var(--shadow-dark);
      border-radius: 15px; /* Rounded corners for the whole table */
      overflow: hidden; /* Ensures border-radius applies */
      background: rgba(255, 255, 255, 0.05); /* Base background for table */
    }

    th {
      background: rgba(0, 207, 255, 0.25); /* Stronger accent blue header */
      color: var(--text-lighter);
      padding: 18px; /* More padding */
      text-align: left;
      font-weight: 600;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Subtle white border */
    }

    td {
      padding: 15px 18px; /* More padding */
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      color: var(--text-light);
    }

    tr:nth-child(even) {
      background: rgba(255, 255, 255, 0.02); /* Lighter subtle stripe effect */
    }

    tr:hover {
      background: rgba(255, 255, 255, 0.1); /* More noticeable highlight on hover */
      cursor: pointer;
    }

    /* Ensure first and last row/cells have rounded corners */
    table thead tr:first-child th:first-child {
      border-top-left-radius: 15px;
    }
    table thead tr:first-child th:last-child {
      border-top-right-radius: 15px;
    }
    table tbody tr:last-child td:first-child {
      border-bottom-left-radius: 15px;
    }
    table tbody tr:last-child td:last-child {
      border-bottom-right-radius: 15px;
    }

    .status-badge {
      display: inline-block;
      padding: 6px 14px; /* Larger padding */
      border-radius: 25px; /* More rounded */
      font-size: 0.9rem; /* Slightly larger font */
      font-weight: 600; /* Bolder */
      text-transform: uppercase; /* Uppercase text */
    }

    .status-benefit {
      background: rgba(39, 174, 96, 0.25); /* Stronger background */
      color: #27ae60;
    }

    .status-cost {
      background: rgba(231, 76, 60, 0.25); /* Stronger background */
      color: #e74c3c;
    }

    .ranking-table tr:first-child {
      background: rgba(255, 215, 0, 0.2); /* Gold background for 1st rank */
    }

    .ranking-table tr:first-child td {
      font-weight: 700;
      font-size: 1.2rem; /* Larger font for 1st rank */
      color: var(--text-lighter);
    }

    .ranking-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px; /* Larger badge */
      height: 40px;
      border-radius: 50%;
      background: var(--accent-blue);
      color: var(--primary-dark); /* Darker text for contrast */
      font-weight: 700;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
      border: 2px solid rgba(255, 255, 255, 0.2); /* Subtle border */
    }

    .ranking-1 {
      background: linear-gradient(45deg, #FFD700, #FFA500); /* Gold gradient */
      color: #333;
      box-shadow: 0 4px 10px rgba(255, 215, 0, 0.5);
    }

    .ranking-2 {
      background: linear-gradient(45deg, #C0C0C0, #A9A9A9); /* Silver gradient */
      color: #333;
      box-shadow: 0 4px 10px rgba(192, 192, 192, 0.5);
    }

    .ranking-3 {
      background: linear-gradient(45deg, #CD7F32, #8B4513); /* Bronze gradient */
      color: white;
      box-shadow: 0 4px 10px rgba(205, 127, 50, 0.5);
    }

    .alert {
      padding: 18px; /* More padding */
      border-radius: 10px;
      margin-bottom: 25px;
      display: flex;
      align-items: flex-start; /* Align icon to top */
      background: rgba(0, 207, 255, 0.15); /* Stronger light blue background */
      border-left: 5px solid var(--accent-blue); /* Thicker border */
      color: var(--accent-blue);
      box-shadow: 0 4px 10px rgba(0, 207, 255, 0.2);
    }

    .alert i {
      margin-right: 15px; /* More space */
      font-size: 1.8rem; /* Larger icon */
      color: var(--accent-blue);
    }

    .alert p {
      color: var(--text-light);
      font-size: 1rem;
    }

    .alert strong {
        color: var(--text-lighter);
        font-size: 1.1rem;
        display: block;
        margin-bottom: 5px;
    }

    .progress-container {
      margin: 30px 0;
      background: rgba(255, 255, 255, 0.08); /* Slightly more opaque */
      border-radius: 10px;
      padding: 20px; /* More padding */
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .progress-bar {
      height: 12px; /* Thicker progress bar */
      background: rgba(255, 255, 255, 0.1);
      border-radius: 6px;
      overflow: hidden;
      margin-bottom: 12px;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--accent-blue), var(--accent-purple)); /* Blue to purple gradient */
      border-radius: 6px;
      transition: width 0.6s ease-out; /* Smoother width transition */
    }

    .progress-container p {
      color: var(--text-light);
      font-weight: 500;
      text-align: right; /* Align text to right */
    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Larger min width for cards */
      gap: 25px; /* More space between cards */
      margin-top: 25px;
    }

    .card {
      background: rgba(255, 255, 255, 0.08); /* More opaque */
      border-radius: 20px;
      box-shadow: var(--shadow-dark);
      padding: 25px; /* More padding */
      text-align: center;
      transition: transform 0.4s ease, background 0.4s ease, box-shadow 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .card:hover {
      transform: translateY(-8px);
      background: rgba(255, 255, 255, 0.12);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5);
    }

    .card i {
      font-size: 3.5rem; /* Larger icons */
      color: var(--accent-blue);
      margin-bottom: 20px; /* More space */
      text-shadow: 0 0 15px rgba(0, 207, 255, 0.4); /* Icon glow */
    }

    .card h3 {
      font-size: 1.6rem; /* Larger headings */
      margin-bottom: 12px;
      color: var(--text-lighter);
    }

    .card p {
      font-size: 2.5rem; /* Larger numbers */
      font-weight: 700;
      color: var(--accent-purple); /* Changed to purple for numbers */
      text-shadow: 0 0 10px rgba(138, 43, 226, 0.4);
    }

    .footer {
      text-align: center;
      margin-top: 60px; /* More space from content */
      color: var(--text-light);
      opacity: 0.8;
      font-size: 0.95rem;
      padding: 20px 0;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* --- New Styles for Add Criteria Form --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1001;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: var(--primary-dark); /* Darker background for modal */
        padding: 35px;
        border-radius: 20px;
        box-shadow: var(--shadow-dark);
        width: 90%;
        max-width: 600px;
        transform: translateY(-20px);
        transition: transform 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .modal-overlay.active .modal-content {
        transform: translateY(0);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-header h3 {
        color: var(--text-lighter);
        font-size: 1.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-header .close-btn {
        background: none;
        border: none;
        color: var(--text-light);
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .modal-header .close-btn:hover {
        color: var(--accent-blue);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }

    /* End New Styles */

    @media (max-width: 992px) {
      .hero-section {
        flex-direction: column;
        text-align: center;
        padding: 60px 20px;
      }

      .hero-content {
        padding-right: 0;
        margin-bottom: 40px;
      }

      .illustration-container {
        width: 100%;
        max-width: 450px; /* Constrain illustration width on smaller screens */
        height: 350px;
      }

      .hero-section h1 {
        font-size: 3rem;
      }

      .hero-section .subtitle {
        font-size: 1.3rem;
      }

      .header-content {
        flex-direction: column;
        align-items: center;
      }

      .site-title {
        margin-top: 15px;
        margin-bottom: 10px;
      }

      nav {
        width: 100%;
      }

      .nav-links {
        flex-direction: column;
        margin-top: 20px;
      }

      .nav-links li {
        width: 100%;
        text-align: center;
        margin: 8px 0;
      }

      .nav-links a {
        padding: 12px;
      }

      .btn-logout {
        margin-top: 20px;
        margin-left: 0;
        width: 80%; /* Make logout button wider */
        max-width: 250px;
      }

      h2 {
        font-size: 1.8rem;
      }

      .section {
        padding: 25px;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 576px) {
      .hero-section h1 {
        font-size: 2.5rem;
      }

      .hero-section .subtitle {
        font-size: 1.1rem;
      }

      .illustration-container {
        height: 250px;
      }

      h2 {
        font-size: 1.5rem;
        text-align: center;
        flex-direction: column;
      }
      .section-header {
        flex-direction: column;
        gap: 15px;
      }
      .btn {
        width: 100%;
        text-align: center;
        justify-content: center;
      }

      table th, table td {
        padding: 10px 12px;
        font-size: 0.9rem;
      }

      .card h3 {
        font-size: 1.3rem;
      }
      .card p {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <div class="bg-element-1"></div>
  <div class="bg-element-2"></div>

  <header>
    <div class="container">
      <div class="header-content">
        <div class="logo-title-container">
          <div class="logo">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <span class="site-title">SAW SPK</span>
        </div>
        <nav>
          <ul class="nav-links">
            <li><a href="#home" class="active"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#alternatif"><i class="fas fa-users"></i> Data Alternatif</a></li>
            <li><a href="#kriteria"><i class="fas fa-list"></i> Data Kriteria</a></li>
            <li><a href="#perhitungan"><i class="fas fa-calculator"></i> Data Nilai</a></li>
            <li><a href="#ranking"><i class="fas fa-trophy"></i> Hasil</a></li>
            <li><a href="#" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <div class="container">
    <main>
      <section id="home" class="hero-section">
        <div class="hero-content">
          <h1>Sistem Pendukung Keputusan <span>SAW</span></h1>
          <p class="subtitle">Pemilihan Siswa Berprestasi Menggunakan Metode Simple Additive Weighting (SAW)</p>
        </div>
        <div class="illustration-container">
          </div>
      </section>

      <section id="kriteria" class="section">
        <div class="section-header">
          <h2><i class="fas fa-list"></i> Data Kriteria</h2>
          <button class="btn" id="addCriteriaBtn"><i class="fas fa-plus"></i> Tambah Kriteria</button>
        </div>

        <div class="alert">
          <i class="fas fa-info-circle"></i>
          <div>
            <strong>Informasi Bobot Kriteria</strong>
            <p>Total bobot harus bernilai 1. Kriteria benefit semakin tinggi semakin baik, cost semakin rendah semakin baik.</p>
          </div>
        </div>

        <div class="progress-container">
          <div class="progress-bar">
            <div class="progress-fill" style="width: 100%"></div>
          </div>
          <p>Total Bobot: <strong id="totalBobotDisplay">1.00</strong> (100%)</p>
        </div>

        <table id="criteriaTable">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Kriteria</th>
              <th>Bobot</th>
              <th>Tipe</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>C1</td>
              <td>Prestasi Kompetisi</td>
              <td>0.30</td>
              <td><span class="status-badge status-benefit">Benefit</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, 'C1', 'Prestasi Kompetisi', 0.30, 'Benefit')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, 'C1')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
            <tr>
              <td>C2</td>
              <td>Nilai Akademik</td>
              <td>0.20</td>
              <td><span class="status-badge status-benefit">Benefit</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, 'C2', 'Nilai Akademik', 0.20, 'Benefit')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, 'C2')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
            <tr>
              <td>C3</td>
              <td>Nilai Keterampilan</td>
              <td>0.20</td>
              <td><span class="status-badge status-benefit">Benefit</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, 'C3', 'Nilai Keterampilan', 0.20, 'Benefit')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, 'C3')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
            <tr>
              <td>C4</td>
              <td>Absensi (Hari)</td>
              <td>0.15</td>
              <td><span class="status-badge status-cost">Cost</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, 'C4', 'Absensi (Hari)', 0.15, 'Cost')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, 'C4')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
            <tr>
              <td>C5</td>
              <td>Organisasi</td>
              <td>0.15</td>
              <td><span class="status-badge status-benefit">Benefit</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, 'C5', 'Organisasi', 0.15, 'Benefit')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, 'C5')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="alternatif" class="section">
        <div class="section-header">
          <h2><i class="fas fa-users"></i> Data Alternatif</h2>
          <button class="btn"><i class="fas fa-plus"></i> Tambah Alternatif</button>
        </div>

        <div class="card-container">
          <div class="card">
            <i class="fas fa-user-graduate"></i>
            <h3>Total Siswa</h3>
            <p>10</p>
          </div>
          <div class="card">
            <i class="fas fa-chart-line"></i>
            <h3>Nilai Tertinggi</h3>
            <p>95</p>
          </div>
          <div class="card">
            <i class="fas fa-chart-bar"></i>
            <h3>Nilai Terendah</h3>
            <p>27.9</p>
          </div>
          <div class="card">
            <i class="fas fa-calculator"></i>
            <h3>Rata-rata</h3>
            <p>55.4</p>
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Prestasi</th>
              <th>Akademik</th>
              <th>Keterampilan</th>
              <th>Absensi</th>
              <th>Organisasi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Muslina Simangunsong</td>
              <td>X RPL 1</td>
              <td>Tidak Ada</td>
              <td>77</td>
              <td>78</td>
              <td>0</td>
              <td>0</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Nur Fadhila</td>
              <td>XI RPL 2</td>
              <td>Tingkat Provinsi</td>
              <td>85</td>
              <td>86</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Mawaddah Sitorus</td>
              <td>XII RPL 1</td>
              <td>Tidak Ada</td>
              <td>81</td>
              <td>83</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Fitriani Sitepu</td>
              <td>XI RPL 1</td>
              <td>Tidak Ada</td>
              <td>75</td>
              <td>77</td>
              <td>0</td>
              <td>1</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Maulida Putri</td>
              <td>X RPL 2</td>
              <td>Tidak Ada</td>
              <td>75</td>
              <td>76</td>
              <td>2</td>
              <td>0</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="perhitungan" class="section">
        <div class="section-header">
          <h2><i class="fas fa-calculator"></i> Data Nilai</h2>
          <button class="btn"><i class="fas fa-sync-alt"></i> Hitung Ulang</button>
        </div>

        <h3><i class="fas fa-table"></i> Rating Kecocokan</h3>
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Prestasi (C1)</th>
              <th>Akademik (C2)</th>
              <th>Keterampilan (C3)</th>
              <th>Absensi (C4)</th>
              <th>Organisasi (C5)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Muslina Simangunsong</td>
              <td>0.00</td>
              <td>0.25</td>
              <td>0.25</td>
              <td>1.00</td>
              <td>0.00</td>
            </tr>
            <tr>
              <td>Nur Fadhila</td>
              <td>0.75</td>
              <td>0.50</td>
              <td>0.75</td>
              <td>0.75</td>
              <td>0.25</td>
            </tr>
            <tr>
              <td>Mawaddah Sitorus</td>
              <td>0.00</td>
              <td>0.50</td>
              <td>0.50</td>
              <td>0.75</td>
              <td>0.25</td>
            </tr>
          </tbody>
        </table>

        <h3 style="margin-top: 30px;"><i class="fas fa-chart-bar"></i> Normalisasi</h3>
        <table>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Prestasi (C1)</th>
              <th>Akademik (C2)</th>
              <th>Keterampilan (C3)</th>
              <th>Absensi (C4)</th>
              <th>Organisasi (C5)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Muslina Simangunsong</td>
              <td>0.00</td>
              <td>0.50</td>
              <td>0.33</td>
              <td>1.00</td>
              <td>0.00</td>
            </tr>
            <tr>
              <td>Nur Fadhila</td>
              <td>1.00</td>
              <td>1.00</td>
              <td>1.00</td>
              <td>0.75</td>
              <td>0.33</td>
            </tr>
            <tr>
              <td>Mawaddah Sitorus</td>
              <td>0.00</td>
              <td>1.00</td>
              <td>0.67</td>
              <td>0.75</td>
              <td>0.33</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="ranking" class="section">
        <div class="section-header">
          <h2><i class="fas fa-trophy"></i> Hasil Ranking</h2>
          <button class="btn"><i class="fas fa-download"></i> Export PDF</button>
        </div>

        <div class="alert">
          <i class="fas fa-info-circle"></i>
          <div>
            <strong>Informasi Perhitungan</strong>
            <p>Hasil perhitungan menunjukkan 3 siswa terbaik berdasarkan kriteria yang telah ditentukan.</p>
          </div>
        </div>

        <table class="ranking-table">
          <thead>
            <tr>
              <th>Ranking</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Nilai Preferensi (Vi)</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="ranking-badge ranking-1">1</span></td>
              <td>Bayu Pratama</td>
              <td>XI TKJ 1</td>
              <td>0.95</td>
              <td><button class="btn"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
            <tr>
              <td><span class="ranking-badge ranking-2">2</span></td>
              <td>Nur Fadhila</td>
              <td>XI RPL 2</td>
              <td>0.86</td>
              <td><button class="btn"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
            <tr>
              <td><span class="ranking-badge ranking-3">3</span></td>
              <td>Afny Rizani</td>
              <td>XI TKJ 2</td>
              <td>0.86</td>
              <td><button class="btn"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
            <tr>
              <td><span class="ranking-badge">4</span></td>
              <td>Nadilah Iramaya</td>
              <td>XI TKJ 2</td>
              <td>0.70</td>
              <td><button class="btn"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
            <tr>
              <td><span class="ranking-badge">5</span></td>
              <td>Anju Alba Sitompul</td>
              <td>X TKJ 1</td>
              <td>0.60</td>
              <td><button class="btn"><i class="fas fa-eye"></i> Lihat</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>

    <div class="footer">
      <p>© 2023 Sistem Pendukung Keputusan SAW - Pemilihan Siswa Berprestasi</p>
      <p>Dikembangkan oleh Kelompok X - Teknik Informatika</p>
    </div>
  </div>

  <div id="criteriaModal" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle"><i class="fas fa-plus"></i> Tambah Kriteria Baru</h3>
        <button class="close-btn" id="closeModalBtn">&times;</button>
      </div>
      <form id="criteriaForm">
        <input type="hidden" id="editRowIndex">
        <div class="form-group">
          <label for="kode">Kode Kriteria</label>
          <input type="text" id="kode" name="kode" required placeholder="C6, C7, dst.">
        </div>
        <div class="form-group">
          <label for="kriteria">Nama Kriteria</label>
          <input type="text" id="kriteria" name="kriteria" required placeholder="Contoh: Kedisiplinan">
        </div>
        <div class="form-group">
          <label for="bobot">Bobot</label>
          <input type="number" id="bobot" name="bobot" step="0.01" min="0" max="1" required placeholder="Contoh: 0.20">
        </div>
        <div class="form-group">
          <label for="tipe">Tipe</label>
          <select id="tipe" name="tipe" required>
            <option value="">Pilih Tipe</option>
            <option value="Benefit">Benefit</option>
            <option value="Cost">Cost</option>
          </select>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-danger" id="cancelFormBtn"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-success" id="saveCriteriaBtn"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Simple navigation highlighting
    document.addEventListener('DOMContentLoaded', function() {
      const navLinks = document.querySelectorAll('.nav-links a');

      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          navLinks.forEach(l => l.classList.remove('active'));
          this.classList.add('active');
        });
      });

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();

          document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
          });
        });
      });

      // Add animation to sections when they come into view
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, { threshold: 0.1 });

      document.querySelectorAll('.section').forEach(section => {
        section.style.opacity = 0;
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(section);
      });

      // Initially set the 'Home' link as active if it's the default view
      const homeLink = document.querySelector('.nav-links a[href="#home"]');
      if (homeLink) {
        homeLink.classList.add('active');
      }

      // --- Modal and Form Logic ---
      const addCriteriaBtn = document.getElementById('addCriteriaBtn');
      const criteriaModal = document.getElementById('criteriaModal');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const cancelFormBtn = document.getElementById('cancelFormBtn');
      const criteriaForm = document.getElementById('criteriaForm');
      const modalTitle = document.getElementById('modalTitle');
      const kodeInput = document.getElementById('kode');
      const kriteriaInput = document.getElementById('kriteria');
      const bobotInput = document.getElementById('bobot');
      const tipeSelect = document.getElementById('tipe');
      const editRowIndexInput = document.getElementById('editRowIndex');
      const criteriaTableBody = document.querySelector('#criteriaTable tbody');
      const totalBobotDisplay = document.getElementById('totalBobotDisplay');

      let currentCriteriaData = []; // To store criteria for client-side operations

      // Function to update total bobot display
      function updateTotalBobot() {
          let totalBobot = 0;
          const rows = criteriaTableBody.querySelectorAll('tr');
          rows.forEach(row => {
              const bobotText = row.children[2].textContent;
              totalBobot += parseFloat(bobotText);
          });
          totalBobotDisplay.textContent = totalBobot.toFixed(2);
      }

      // Initial calculation for existing rows
      updateTotalBobot();


      addCriteriaBtn.addEventListener('click', () => {
        // Reset form for adding new data
        criteriaForm.reset();
        editRowIndexInput.value = ''; // Clear hidden input for editing
        modalTitle.innerHTML = '<i class="fas fa-plus"></i> Tambah Kriteria Baru';
        criteriaModal.classList.add('active');
      });

      closeModalBtn.addEventListener('click', () => {
        criteriaModal.classList.remove('active');
      });

      cancelFormBtn.addEventListener('click', () => {
        criteriaModal.classList.remove('active');
      });

      criteriaForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const kode = kodeInput.value.trim();
        const kriteria = kriteriaInput.value.trim();
        const bobot = parseFloat(bobotInput.value);
        const tipe = tipeSelect.value;
        const rowIndex = editRowIndexInput.value;

        if (!kode || !kriteria || isNaN(bobot) || bobot <= 0 || !tipe) {
          alert('Mohon lengkapi semua field dengan benar.');
          return;
        }

        // --- Frontend Logic to Add/Update Row ---
        if (rowIndex !== '') {
            // Editing existing row
            const row = criteriaTableBody.children[parseInt(rowIndex)];
            row.children[0].textContent = kode;
            row.children[1].textContent = kriteria;
            row.children[2].textContent = bobot.toFixed(2); // Format bobot
            const tipeSpan = row.children[3].querySelector('.status-badge');
            tipeSpan.textContent = tipe;
            tipeSpan.className = 'status-badge ' + (tipe === 'Benefit' ? 'status-benefit' : 'status-cost');

            // Update onclick functions for edit/delete if needed (e.g., if kode changes)
            row.querySelector('.btn-warning').setAttribute('onclick', `editCriteria(this, '${kode}', '${kriteria}', ${bobot.toFixed(2)}, '${tipe}')`);
            row.querySelector('.btn-danger').setAttribute('onclick', `deleteCriteria(this, '${kode}')`);

            alert('Kriteria berhasil diperbarui (Frontend saja)!');
        } else {
            // Adding new row
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
              <td>${kode}</td>
              <td>${kriteria}</td>
              <td>${bobot.toFixed(2)}</td>
              <td><span class="status-badge status-${tipe.toLowerCase()}">${tipe}</span></td>
              <td>
                <div class="btn-action-group">
                  <button class="btn btn-warning" onclick="editCriteria(this, '${kode}', '${kriteria}', ${bobot.toFixed(2)}, '${tipe}')"><i class="fas fa-edit"></i> Edit</button>
                  <button class="btn btn-danger" onclick="deleteCriteria(this, '${kode}')"><i class="fas fa-trash"></i> Hapus</button>
                </div>
              </td>
            `;
            criteriaTableBody.appendChild(newRow);
            alert('Kriteria baru berhasil ditambahkan (Frontend saja)!');
        }

        updateTotalBobot(); // Recalculate total bobot after add/edit

        criteriaModal.classList.remove('active'); // Hide the modal
      });
    });

    // --- Global functions for Edit and Delete (now modified to handle client-side updates) ---
    // 'element' parameter refers to the button clicked, to easily find its parent row.
    function editCriteria(buttonElement, kode, kriteria, bobot, tipe) {
        // Find the parent row of the clicked button
        const row = buttonElement.closest('tr');
        if (!row) {
            console.error('Could not find parent row for editing.');
            return;
        }

        // Populate the modal form with current row data
        document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Kriteria';
        document.getElementById('kode').value = kode;
        document.getElementById('kriteria').value = kriteria;
        document.getElementById('bobot').value = bobot;
        document.getElementById('tipe').value = tipe;

        // Store the index of the row being edited in a hidden input
        // This is crucial to know which row to update after form submission
        document.getElementById('editRowIndex').value = Array.from(row.parentNode.children).indexOf(row);

        // Show the modal
        document.getElementById('criteriaModal').classList.add('active');

        // --- BACKEND INTEGRATION POINT for EDIT ---
        // In a real application, you would fetch the data from the server
        // based on the 'kode' and then populate the form.
        // Example:
        // fetch(`api/get_kriteria.php?kode=${kode}`)
        //   .then(response => response.json())
        //   .then(data => {
        //     document.getElementById('kode').value = data.kode;
        //     document.getElementById('kriteria').value = data.kriteria;
        //     document.getElementById('bobot').value = data.bobot;
        //     document.getElementById('tipe').value = data.tipe;
        //     // ... then show modal
        //   });
    }

    function deleteCriteria(buttonElement, kode) {
      if (confirm('Apakah Anda yakin ingin menghapus kriteria ' + kode + '?')) {
        // --- Frontend Logic to Delete Row ---
        const row = buttonElement.closest('tr');
        if (row) {
            row.remove(); // Remove the row from the table
            document.getElementById('totalBobotDisplay').textContent = (parseFloat(document.getElementById('totalBobotDisplay').textContent) - parseFloat(row.children[2].textContent)).toFixed(2);
            alert('Kriteria ' + kode + ' berhasil dihapus (Frontend saja)!');
        }

        // --- BACKEND INTEGRATION POINT for DELETE ---
        // In a real application, you would send a request to your backend
        // to delete the data from the database.
        // Example:
        // fetch(`api/delete_kriteria.php?kode=${kode}`, { method: 'POST' })
        //   .then(response => response.json())
        //   .then(data => {
        //     if (data.success) {
        //       row.remove(); // Only remove if deletion on server is successful
        //       alert('Kriteria ' + kode + ' berhasil dihapus!');
        //     } else {
        //       alert('Gagal menghapus kriteria: ' + data.message);
        //     }
        //   })
        //   .catch(error => console.error('Error:', error));
      }
    }
  </script>
</body>
</html>