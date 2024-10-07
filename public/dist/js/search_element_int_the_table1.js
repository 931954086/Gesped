
function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("filterInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("AllTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        var idColumn = tr[i].getElementsByTagName("td")[0];
        var nameColumn = tr[i].getElementsByTagName("td")[1];

        if (idColumn || nameColumn) {
            var idValue = idColumn.textContent || idColumn.innerText;
            var nameValue = nameColumn.textContent || nameColumn.innerText;

            if (idValue.toUpperCase().indexOf(filter) > -1 || nameValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
document.getElementById("filterInput").addEventListener("input", function() {
    filterTable();
});
