@extends('admin.templateAdmin')

<title>Submit an Article</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">

@section('content')

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <!-- Wrapper untuk foto, username, dan role -->
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="{{ asset('images/default-profile.jpg') }}" alt="User Avatar">
                    </div>
                    <div class="user-details">
                        <h2>{{ Auth::user()->family_name }}</h2> <!-- Username pengguna yang sedang login -->
                        <p>{{ Auth::user()->role }}</p> <!-- Role pengguna yang sedang login -->
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('user.index') }}">My Journal</a></li>
            </ul>

            <!-- Pindahkan elemen ke bagian bawah sidebar -->
            <div class="sidebar-footer">
                <h4>Jurnal Kesehatan</h4>
                <p>ISSN (P) 2086-255X</p>
                <p>ISSN (E) 2022-7761</p>
                <hr>
                <h5>New Submission</h5>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-grow-1 p-4 ">
            <h3 class="mb-4">Submit an Article</h3>
            <ul class="nav nav-tabs mb-4" id="submissionTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-step="1">1. Start</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" data-step="2">2. Upload Submission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" data-step="3">3. Enter Metadata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" data-step="4">4. Confirmation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" data-step="5">5. Next Steps</a>
                </li>
            </ul>

            <form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Start -->
                <div id="step1" class="mt-4">
                    <div class="card p-4 mb-4">
                        <div class="mb-3">
                            <label class="form-label">Submission Language</label>
                            <select class="form-select">
                                <option>English</option>
                                <option>Indonesian</option>
                            </select>
                            <small class="text-muted">Submissions in several languages are accepted.</small>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="volume" required>
                                <option>Select a section</option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Articles must be submitted to one of the journal's sections.</small>
                        </div>
                    </div>

                    <div class="card p-4 mb-4">
                        <h5>Submission Requirements</h5>
                        <p class="text-muted">You must read and acknowledge the requirements below before proceeding.</p>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">The submission has not been previously published</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">The manuscript is original work and not plagiarism</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">The submission file is in Microsoft Word (doc or rtf)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">The text adheres to the stylistic and bibliographic requirements</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">The submission includes author details</label>
                        </div>
                    </div>

                    <div class="card p-4 mb-4">
                        <h5>Comments for the Editor</h5>
                        <input id="editor" type="hidden" name="comment">
                        <trix-editor input="editor" class="trix-content"></trix-editor>
                    </div>

                    <div class="card p-4 mb-4">
                        <h5>Corresponding Contact <span class="text-danger">*</span></h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">I agree to be contacted about this submission.</label>
                        </div>
                    </div>

                    <div class="card p-4 mb-4">
                        <h5>Acknowledge the copyright statement</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">Yes, I agree to abide by the terms of the copyright statement.</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label">Yes, I agree to have my data collected and stored according to the <a href="#">privacy statement</a>.</label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Save and continue</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </div>
                </div>

                <!-- Step 2: Upload Submission -->
                <div id="step2" class="mt-4" style="display: none;">
                    <div class="card p-4 mb-4">
                        <h4>Upload Submission</h4>
                        <p class="text-muted">Please upload your manuscript file in Microsoft Word (doc or rtf) format.</p>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Upload File</label>
                            <input class="form-control" type="file" name="file" id="fileUpload" accept=".doc,.docx,.rtf" required>
                            <small class="text-muted">Maximum file size: 5MB</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Save and continue</button>
                    <button type="button" class="btn btn-danger" onclick="previousStep(1)">Back</button>
                </div>

                <!-- Step 3: Enter Metadata -->
                <div id="step3" class="mt-4" style="display: none;">
                    <div class="card p-4 mb-4">
                        <h4>Enter Metadata</h4>
                        <p class="text-muted">Provide the necessary metadata for your submission.</p>
                        <div class="mb-3">
                            <label for="title" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="title" name="subtitle" required placeholder="Enter the title of your article">
                        </div>
                        <div class="mb-3">
                            <label for="abstract" class="form-label">Abstract</label>
                            <textarea class="form-control" id="abstract" name="abstract" rows="5" required placeholder="Enter the abstract"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" required placeholder="Enter keywords separated by commas">
                        </div>
                        <div class="mb-3">
                            <label for="authors" class="form-label">Authors</label>
                            <input type="text" class="form-control" id="authors" name="authors" required placeholder="Enter authors separated by commas">
                        </div>
                        <div class="mb-3">
                            <label for="pages" class="form-label">Pages</label>
                            <input type="text" class="form-control" id="pages" name="pages" required placeholder="Enter pages separated by commas">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="nextStep(4)">Save and continue</button>
                    <button type="button" class="btn btn-danger" onclick="previousStep(2)">Back</button>
                </div>

                <!-- Step 4: Confirmation -->
                <div id="step4" class="mt-4" style="display: none;">
                    <div class="card p-4 mb-4">
                        <h4>Confirmation</h4>
                        <p class="text-muted">Please review your submission details before finalizing.</p>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Submission Details</h5>
                                <p><strong>Title:</strong> <span id="reviewTitle"></span></p>
                                <p><strong>Abstract:</strong> <span id="reviewAbstract"></span></p>
                                <p><strong>Keywords:</strong> <span id="reviewKeywords"></span></p>
                                <p><strong>File:</strong> <span id="reviewFile"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Confirm and Submit</button>
                        <button type="button" class="btn btn-danger" onclick="previousStep(3)">Back</button>
                    </div>
                </div>
            </form>

            <!-- Step 5: Next Steps -->
            <div id="step5" class="mt-4" style="display: none;">
                <div class="card p-4 mb-4">
                    <h4>Next Steps</h4>
                    <p class="text-muted">Your submission has been received. Here are the next steps:</p>
                    <ul>
                        <li>Wait for the editorial team to review your submission.</li>
                        <li>You will be notified via email about the status of your submission.</li>
                        <li>Check your dashboard for updates.</li>
                    </ul>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/dashboard'">Return to Dashboard</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script>
        // Function to handle step navigation
        function nextStep(step) {
            // Save data to localStorage before moving to the next step
            if (step === 2) {
                const language = document.querySelector('.form-select').value;
                const sectionId = document.querySelector('select[name="volume"]').value;
                localStorage.setItem('language', language);
                localStorage.setItem('sectionId', sectionId);
            } else if (step === 3) {
                const file = document.getElementById('fileUpload').files[0];
                if (file) {
                    localStorage.setItem('fileName', file.name);
                }
            } else if (step === 4) {
                const title = document.getElementById('title').value;
                const abstract = document.getElementById('abstract').value;
                const keywords = document.getElementById('keywords').value;
                localStorage.setItem('title', title);
                localStorage.setItem('abstract', abstract);
                localStorage.setItem('keywords', keywords);
            }

            // Hide all steps
            document.querySelectorAll('[id^="step"]').forEach(div => {
                div.style.display = 'none';
            });

            // Show the current step
            document.getElementById(`step${step}`).style.display = 'block';

            // Update the active tab
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-step') == step) {
                    link.classList.add('active');
                }
            });

            // Enable the next tab
            if (step < 5) {
                const nextTab = document.querySelector(`[data-step="${step}"]`);
                const prevTab = document.querySelector(`[data-step="${step - 1}"]`);
                if (nextTab) {
                    nextTab.classList.remove('disabled');
                    if (prevTab) prevTab.classList.add('disabled');
                }
            }

            // If on confirmation step, populate review fields
            if (step === 4) {
                document.getElementById('reviewTitle').textContent = localStorage.getItem('title');
                document.getElementById('reviewAbstract').textContent = localStorage.getItem('abstract');
                document.getElementById('reviewKeywords').textContent = localStorage.getItem('keywords');
                document.getElementById('reviewFile').textContent = localStorage.getItem('fileName') || 'No file uploaded';
            }
        }

        function previousStep(step) {
            nextStep(step);
        }

        // Function to validate form inputs
        function validateForm(step) {
            let isValid = true;

            if (step === 1) {
                const checkboxes = document.querySelectorAll('#step1 .form-check-input');
                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        isValid = false;
                    }
                });
            } else if (step === 2) {
                const fileInput = document.getElementById('fileUpload');
                if (!fileInput.files.length) {
                    isValid = false;
                }
            } else if (step === 3) {
                const title = document.getElementById('title').value;
                const abstract = document.getElementById('abstract').value;
                const keywords = document.getElementById('keywords').value;
                if (!title || !abstract || !keywords) {
                    isValid = false;
                }
            }

            return isValid;
        }

        // Function to enable/disable the "Save and continue" button
        function toggleSaveButton(step) {
            const saveButton = document.querySelector(`#step${step} .btn-primary`);
            if (validateForm(step)) {
                saveButton.disabled = false;
            } else {
                saveButton.disabled = true;
            }
        }

        // Add event listeners to form inputs
        document.querySelectorAll('#step1 .form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', () => toggleSaveButton(1));
        });

        document.getElementById('fileUpload').addEventListener('change', () => toggleSaveButton(2));

        document.querySelectorAll('#step3 input, #step3 textarea').forEach(input => {
            input.addEventListener('input', () => toggleSaveButton(3));
        });

        // Initialize the first step
        nextStep(1);
        toggleSaveButton(1);
    </script>
</body>

@endsection