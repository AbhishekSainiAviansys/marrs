<button id="gmLoginBtn">Login to GradeMarker</button>

<script>
document.getElementById("gmLoginBtn").addEventListener("click", function() {

    let payload = {
        identity: "kumar.s@aviansys-tech.com",
        password: "25LUAB175000DEMO"
    };

    fetch("https://grademarker.online/auth/login_to_grademarker", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
    .then(async (response) => {
        const text = await response.text();

        // DEBUG if HTML is returned
        if (text.startsWith("<!DOCTYPE") || text.startsWith("<html")) {
            console.error("❌ SERVER RETURNED HTML, NOT JSON:", text);
            alert("Server returned HTML. Fix API.");
            return;
        }

        return JSON.parse(text);
    })
    .then(data => {
        if (!data) return;

        if (data.status === true) {
            window.location.href = data.redirect;
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Failed to connect to GradeMarker API");
    });
});
</script>
