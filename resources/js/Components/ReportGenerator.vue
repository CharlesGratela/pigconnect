<template>
  <div>
    <button
      @click="generateReport"
      class="bg-[#c58a61] text-white px-4 py-2 rounded-lg hover:bg-[#b37a51] transition-colors duration-200 flex items-center gap-2"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      Generate Report
    </button>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  analytics: {
    type: Object,
    required: true
  },
  expenses: {
    type: Array,
    required: true
  },
  pigs: {
    type: Array,
    required: true
  }
});

const generateReport = async () => {
  try {
    // Validate data
    if (!props.analytics) {
      throw new Error('Analytics data is not available');
    }

    // Import and initialize jsPDF and jspdf-autotable
    const [{ default: jsPDF }, autoTable] = await Promise.all([
      import('jspdf'),
      import('jspdf-autotable')
    ]);
    
    // Create new jsPDF instance
    const doc = new jsPDF();
    
    const pageWidth = doc.internal.pageSize.getWidth();
    const margin = 20;
    let yOffset = 20;

    // Add title
    doc.setFontSize(20);
    doc.setTextColor(84, 52, 52); // #543434
    doc.text('Farm Report', pageWidth / 2, yOffset, { align: 'center' });
    yOffset += 20;

    // Add date
    doc.setFontSize(12);
    doc.text(`Generated on: ${new Date().toLocaleDateString()}`, pageWidth / 2, yOffset, { align: 'center' });
    yOffset += 20;

    // Add analytics section
    doc.setFontSize(16);
    doc.text('Analytics Overview', margin, yOffset);
    yOffset += 10;

    doc.setFontSize(12);
    doc.text(`Total Pigs: ${props.analytics.totalPigs || 0}`, margin, yOffset);
    yOffset += 7;
    doc.text(`Average Weight: ${(props.analytics.averageWeight || 0).toFixed(2)} kg`, margin, yOffset);
    yOffset += 7;
    doc.text(`Average Rating: ${props.analytics.averageRating || 0}`, margin, yOffset);
    yOffset += 7;
    doc.text(`Vaccination Rate: ${props.analytics.percentageVaccinated || 0}%`, margin, yOffset);
    yOffset += 20;

    // Add expenses section
    doc.setFontSize(16);
    doc.text('Expenses Summary', margin, yOffset);
    yOffset += 10;

    doc.setFontSize(12);
    const totalExpenses = (props.expenses || []).reduce((sum, expense) => sum + (expense.cost || 0), 0);
    doc.text(`Total Expenses: ₱${totalExpenses.toFixed(2)}`, margin, yOffset);
    yOffset += 7;

    // Add expenses table if there are expenses
    if (props.expenses && props.expenses.length > 0) {
      const expensesTable = props.expenses.map(expense => [
        expense.name || '',
        expense.type || '',
        `₱${(expense.cost || 0).toFixed(2)}`,
        expense.date_of_purchase || ''
      ]);

      autoTable.default(doc, {
        startY: yOffset,
        head: [['Name', 'Type', 'Cost', 'Date']],
        body: expensesTable,
        theme: 'grid',
        headStyles: { fillColor: [197, 138, 97] }, // #c58a61
        margin: { left: margin },
        styles: {
          fontSize: 10,
          cellPadding: 5,
        },
        columnStyles: {
          0: { cellWidth: 60 },
          1: { cellWidth: 40 },
          2: { cellWidth: 40 },
          3: { cellWidth: 40 },
        },
        didDrawPage: function(data) {
          // Get the table height
          const tableHeight = data.table.height;
          // Update yOffset for next section
          yOffset = data.cursor.y + 20;
        }
      });
    } else {
      // Add message for no expenses
      doc.setFontSize(10);
      doc.setTextColor(128, 128, 128); // Gray color
      doc.text('No expenses recorded', margin, yOffset);
      yOffset += 10;
    }

    // Add pigs inventory section
    doc.setFontSize(16);
    doc.setTextColor(84, 52, 52); // Reset to original color
    doc.text('Pigs Inventory', margin, yOffset);
    yOffset += 10;

    // Add pigs table if there are pigs
    if (props.pigs && props.pigs.length > 0) {
      const pigsTable = props.pigs.map(pig => [
        pig.pigId || '',
        `${(pig.weight || 0).toFixed(2)} kg`,
        pig.breed || '',
        pig.status || '',
        pig.date_of_birth || ''
      ]);

      autoTable.default(doc, {
        startY: yOffset,
        head: [['ID', 'Weight', 'Breed', 'Status', 'Date of Birth']],
        body: pigsTable,
        theme: 'grid',
        headStyles: { fillColor: [197, 138, 97] }, // #c58a61
        margin: { left: margin },
        styles: {
          fontSize: 10,
          cellPadding: 5,
        },
        columnStyles: {
          0: { cellWidth: 30 },
          1: { cellWidth: 30 },
          2: { cellWidth: 40 },
          3: { cellWidth: 30 },
          4: { cellWidth: 40 },
        },
        didDrawPage: function(data) {
          // Get the table height
          const tableHeight = data.table.height;
          // Update yOffset for next section
          yOffset = data.cursor.y + 20;
        }
      });
    } else {
      // Add message for no pigs
      doc.setFontSize(10);
      doc.setTextColor(128, 128, 128); // Gray color
      doc.text('No pigs recorded', margin, yOffset);
    }

    // Save the PDF
    doc.save('farm-report.pdf');
  } catch (error) {
    console.error('Error generating report:', error);
    alert(error.message || 'Error generating report. Please try again.');
  }
};
</script> 