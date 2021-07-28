

<!DOCTYPE html>
<html>
<head>
<style>
.table-layout {
    text-align: center;
    border: 1px solid black;
    border-collapse: collapse;
    font-family:"Trebuchet MS";
    margin: 0 auto 0;
}
.table-layout td, .table-layout th {
    border: 1px solid grey;
    padding: 5px 5px 0;
}
.table-layout td {
    text-align: left;
}
.selected {
    color: red;
}
</style>
</head>
<body>
<table id="display-table" class="table-layout">
    <thead>
        <th>ID</th>
        <th>Company</th>
    </thead>
    <tbody>
        <tr>
            <td>100</td>
            <td>Abc</td>
        </tr>
        <tr>
            <td>101</td>
            <td>Def</td>
        </tr>
        <tr>
            <td>102</td>
            <td>Ghi</td>
        </tr>
    </tbody>
</table>

<script>
highlight_row();
function highlight_row() {
    var table = document.getElementById('display-table');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "yellow";
            rowSelected.className += " selected";

            msg = 'The ID of the company is: ' + rowSelected.cells[0].innerHTML;
            msg += '\nThe cell value is: ' + this.innerHTML;
            alert(msg);
        }
    }

}
</script>
</body>
</html>

