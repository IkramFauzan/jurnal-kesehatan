<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit an Article</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4>Jurnal Kesehatan</h4>
            <p>ISSN (P) 2086-255X</p>
            <p>ISSN (E) 2022-7761</p>
            <hr>
            <h5>New Submission</h5>
        </div>
        
        <!-- Content -->
        <div class="flex-grow-1 p-4">
            <h3>Submit an Article</h3>
            <ul class="nav nav-tabs" id="submissionTabs">
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
            <div class="mt-4">
                <label class="form-label">Submission Language</label>
                <select class="form-select">
                    <option>English</option>
                    <option>Indonesian</option>
                </select>
                <small class="text-muted">Submissions in several languages are accepted.</small>
            </div>
            <div class="mt-3">
                <label class="form-label">Section</label>
                <select class="form-select">
                    <option>Select a section</option>
                </select>
                <small class="text-muted">Articles must be submitted to one of the journal's sections.</small>
            </div>
            <div class="mt-4">
                <h5>Submission Requirements</h5>
                <p class="text-muted">You must read and acknowledge the requirements below before proceeding.</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">The submission has not been previously published</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">The manuscript is original work and not plagiarism</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">The submission file is in Microsoft Word (doc or rtf)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">The text adheres to the stylistic and bibliographic requirements</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">The submission includes author details</label>
                </div>
            </div>
            <div class="mt-4">
                <h5>Comments for the Editor</h5>
                <textarea id="editor" name="comments"></textarea>
            </div>
            <div class="mt-4">
                <h5>Corresponding Contact <span class="text-danger">*</span></h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">I agree to be contacted about this submission.</label>
                </div>
            </div>
            <div class="mt-4">
                <h5>Acknowledge the copyright statement</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">Yes, I agree to abide by the terms of the copyright statement.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">Yes, I agree to have my data collected and stored according to the <a href="#">privacy statement</a>.</label>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save and continue</button>
                <button class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </div>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#editor',
        height: 300,
        menubar: false,
        plugins: 'link image code',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
        content_style: 'body { font-family:Arial,sans-serif; font-size:14px }'
      });

      function nextStep(step) {
        const currentTab = document.querySelector(`.nav-link[data-step="${step - 1}"]`);
        const nextTab = document.querySelector(`.nav-link[data-step="${step}"]`);

        if (currentTab && nextTab) {
            currentTab.classList.remove("active");
            nextTab.classList.remove("disabled");
            nextTab.classList.add("active");
        }
    }

    // Prevent click on disabled tabs
    document.querySelectorAll(".nav-link.disabled").forEach((tab) => {
        tab.addEventListener("click", function (event) {
            event.preventDefault();
            alert("Selesaikan tahap sebelumnya terlebih dahulu!");
        });
    });
    </script>
</body>
</html>
