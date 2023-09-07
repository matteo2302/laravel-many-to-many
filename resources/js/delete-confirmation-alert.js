const deleteForms = document.querySelectorAll(".delete-btn");
deleteForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const hasConfirmed = confirm(
            "Sei sicuro di voler eliminate questo elemento?"
        );
        if (hasConfirmed) form.submit();
    });
});
