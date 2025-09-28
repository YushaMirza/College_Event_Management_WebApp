document.addEventListener("DOMContentLoaded", function () {
    let selectedId = null;

    // When modal opens, get feedback ID
    var confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        selectedId = button.getAttribute('data-id');

        // Update Yes button href (redirect to your route)
        document.getElementById("btn-yes").setAttribute("href", "/dashboard/add-feedback/" + selectedId);
    });

    // On clicking "No", disable the button on table
    document.getElementById("btn-no").addEventListener("click", function () {
        if (selectedId) {
            let btn = document.querySelector('[data-id="'+selectedId+'"]');
            btn.classList.add("disabled");
            btn.setAttribute("title", "Already dismissed");
            btn.removeAttribute("data-bs-toggle"); // prevent reopening
        }
    });
});
