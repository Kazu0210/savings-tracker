function confirmDelete() {
    return confirm("Are you sure you want to delete all records? This action cannot be undone.");
}

const deductAmountBtn = document.getElementById("deduct-amount-btn");
deductAmountBtn.addEventListener('click', function () {
    // show deduct money form
    const deductMoneyForm = document.getElementById("deduct_money_form");
    deductMoneyForm.style.display = "block";

    // hide money form
    const moneyForm = document.getElementById("money_form");
    moneyForm.style.display = "none";
})

function submitDeductForm(inputName) {
    const form = document.getElementById('deductForm');
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = inputName;
    form.appendChild(hiddenInput);
    form.submit();
}