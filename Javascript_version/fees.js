const invoiceInfo = document.getElementById("invoiceInfo");
const payBtn = document.getElementById("payBtn");
const paymentMessage = document.getElementById("paymentMessage");

const studentFeeData = {
    name: "John Doe",
    studentId: "STD2025001",
    semester: "Spring 2025",
    totalFee: 30000,
    paidAmount: 10000,
    dueDate: "2025-06-15",
    history: []
};

function calculateDue(feeData) {
    const today = new Date();
    const due = new Date(feeData.dueDate);
    const daysLate = Math.max(0, Math.ceil((today - due) / (1000 * 60 * 60 * 24)));
    const lateFee = daysLate > 0 ? daysLate * 10 : 0;
    return {
        dueAmount: feeData.totalFee - feeData.paidAmount,
        lateFee,
        totalDue: (feeData.totalFee - feeData.paidAmount) + lateFee
    };
}

function renderInvoice() {
    const { dueAmount, lateFee, totalDue } = calculateDue(studentFeeData);
    invoiceInfo.innerHTML = `
    <p><strong>Name:</strong> ${studentFeeData.name}</p>
    <p><strong>Student ID:</strong> ${studentFeeData.studentId}</p>
    <p><strong>Semester:</strong> ${studentFeeData.semester}</p>
    <p><strong>Total Fee:</strong> ৳${studentFeeData.totalFee}</p>
    <p><strong>Paid:</strong> ৳${studentFeeData.paidAmount}</p>
    <p><strong>Due Amount:</strong> ৳${dueAmount}</p>
    <p><strong>Late Fee:</strong> ৳${lateFee}</p>
    <p><strong>Total Due:</strong> ৳${totalDue}</p>
  `;
}

payBtn.addEventListener("click", () => {
    const { totalDue } = calculateDue(studentFeeData);
    studentFeeData.paidAmount += totalDue;
    studentFeeData.history.push({
        date: new Date().toISOString(),
        amount: totalDue
    });
    paymentMessage.textContent = `Payment of ৳${totalDue} successful.`;
    paymentMessage.style.color = "green";
    renderInvoice();
});

renderInvoice();
