const table = document.getElementById("myTable");
const tbody = document.getElementById("tableBody");
const pagination = document.getElementById("pagination");
let rowsPerPage = 5;
let currentPage = 1;

const rows = Array.from(tbody.querySelectorAll("tr"));

function renderTable() {
    rows.forEach((row, index) => {
        row.style.display = "none";
        if (
            index >= (currentPage - 1) * rowsPerPage &&
            index < currentPage * rowsPerPage
        ) {
            row.style.display = "";
        }
    });
}

function renderPagination() {
    pagination.innerHTML = "";

    const totalPages = Math.ceil(rows.length / rowsPerPage);

    const prev = document.createElement("button");
    prev.textContent = "<";
    prev.onclick = () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
            renderPagination();
        }
    };
    pagination.appendChild(prev);

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        if (i === currentPage) btn.classList.add("active");
        btn.onclick = () => {
            currentPage = i;
            renderTable();
            renderPagination();
        };
        pagination.appendChild(btn);
    }

    const next = document.createElement("button");
    next.textContent = ">";
    next.onclick = () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
            renderPagination();
        }
    };
    pagination.appendChild(next);
}

function sortTable(colIndex) {
    const th = table.querySelectorAll("th")[colIndex];
    const type = th.getAttribute("data-type") || "string";

    const sortedRows = rows.sort((a, b) => {
        let aText = a.children[colIndex].textContent.trim();
        let bText = b.children[colIndex].textContent.trim();

        if (type === "number") {
            return Number(aText) - Number(bText);
        } else {
            return aText.localeCompare(bText);
        }
    });

    // Toggle sort direction
    if (th.dataset.sorted === "asc") {
        sortedRows.reverse();
        th.dataset.sorted = "desc";
    }
    else {
        th.dataset.sorted = "asc";
    }

    tbody.innerHTML = "";
    sortedRows.forEach((row) => tbody.appendChild(row));
    renderTable();
}

// Attach sort to headers
table.querySelectorAll("th").forEach((th, idx) => {
    if (idx < table.querySelectorAll("th").length - 1) {
        th.addEventListener("click", () => sortTable(idx));
    }
});

renderTable();
renderPagination();
