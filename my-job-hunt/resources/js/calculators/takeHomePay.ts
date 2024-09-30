document.addEventListener("DOMContentLoaded", () => {
    const app: HTMLElement | null = document.getElementById('takeHomePay-calculator');
    if (!app) return;

    app.innerHTML = `
        <div class="calculator">
            <h1>Take Home Pay Calculator</h1>
            <div class="input-group">
                <label for="grossSalary">Gross Salary :</label>
                <input type="number" id="grossSalary" name="grossSalary" placeholder="Enter gross salary">
            </div>
            <div class="input-group">
                <label for="federalTax">Federal Tax :</label>
                <input type="number" id="federalTax" name="federalTax" placeholder="Enter federal tax">
            </div>
            <div class="input-group">
                <label for="stateTax">State Tax :</label>
                <input type="number" id="stateTax" name="stateTax" placeholder="Enter state tax">
            </div>
            <div class="input-group">
                <label for="healthInsurance">Health Insurance :</label>
                <input type="number" id="healthInsurance" name="healthInsurance" placeholder="Enter healthInsurance">
            </div>
            <div class="input-group">
                <label for="otherDeductions">Other Deductions :</label>
                <input type="number" id="otherDeductions" name="otherDeductions" placeholder="Enter other deductions">
            </div>
            <button id="calculate" class="btn">Calculate</button>
            <div id="result" class="result"></div>
        </div>
    `;

    const calculateButton: HTMLButtonElement | null = document.getElementById('calculate') as HTMLButtonElement;
    const grossSalaryInput: HTMLInputElement | null = document.getElementById('grossSalary') as HTMLInputElement;
    const federalTaxInput: HTMLInputElement | null = document.getElementById('federalTax') as HTMLInputElement;
    const stateTaxInput: HTMLInputElement | null = document.getElementById('stateTax') as HTMLInputElement;
    const healthInsuranceInput: HTMLInputElement | null = document.getElementById('healthInsurance') as HTMLInputElement;
    const otherDeductionsInput: HTMLInputElement | null = document.getElementById('otherDeductions') as HTMLInputElement;
    const resultDiv: HTMLElement | null = document.getElementById('result');

    if (calculateButton && grossSalaryInput && federalTaxInput && stateTaxInput && healthInsuranceInput && otherDeductionsInput && resultDiv) {
        calculateButton.addEventListener('click', () => {
            const grossSalary: number = parseFloat(grossSalaryInput.value) || 0;
            const federalTax: number = parseFloat(federalTaxInput.value) || 0;
            const stateTax: number = parseFloat(stateTaxInput.value) || 0;
            const healthInsurance: number = parseFloat(healthInsuranceInput.value) || 0;
            const otherDeductions: number = parseFloat(otherDeductionsInput.value) || 0;

            const federalTaxAmount = grossSalary * federalTax;
            const stateTaxAmount = grossSalary * stateTax;

            const totalDeductions = federalTaxAmount + stateTaxAmount + healthInsurance + otherDeductions;

            const takeHomePay: number = grossSalary - totalDeductions;

            resultDiv.textContent = `Take Home Pay: ${takeHomePay}`;
        });
    }
});
