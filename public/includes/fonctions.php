<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script>
function printClients() {
    window.print();
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const elementsToHide = document.querySelectorAll('.no-print');
    elementsToHide.forEach(el => el.style.display = 'none');

    html2canvas(document.getElementById('clients-list')).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const imgWidth = 190;
        const pageHeight = 290;
        const imgHeight = canvas.height * imgWidth / canvas.width;
        let heightLeft = imgHeight;
        let position = 10;

        doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            doc.addPage();
            doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        elementsToHide.forEach(el => el.style.display = '');

        doc.save('clients.pdf');
    });
}

function exportToCSV() {
    var clientsList = document.getElementById('clients-list').getElementsByTagName('li');
    var data = [["ID", "Nom", "Prénom", "Email", "Téléphone", "Adresse", "Sexe", "Statut"]];

    for (var i = 0; i < clientsList.length; i++) {
        var client = clientsList[i].textContent.split(/\s*<br\s*\/?>\s*/); // Adjusted the split regex
        data.push(client);
    }

    var csv = Papa.unparse(data);
    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    if (link.download !== undefined) {
        var url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', 'clients.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}
</script>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #clients-list, #clients-list * {
        visibility: visible;
    }
    #clients-list {
        position: absolute;
        left: 0;
        top: 0;
    }
    .no-print {
        display: none;
    }
}

</style>