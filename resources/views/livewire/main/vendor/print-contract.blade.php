
<div class="">
<style>
    @page {
        size: A4;
        margin: 1in;
    }

    #printable {
        font-family: "Times New Roman", serif;
        font-size: 12pt;
        line-height: 1.6;
        color: #000;
    }

    h1 {
        text-align: center;
        font-size: 16pt;
        margin-bottom: 30px;
        text-transform: uppercase;
    }

    p {
        text-align: justify;
        margin: 10px 0;
    }

    .section-title {
        font-weight: bold;
        margin-top: 20px;
    }

    .indent {
        margin-left: 40px;
    }

    .signature-section {
        margin-top: 50px;
        width: 100%;
    }

    .signature {
        display: inline-block;
        width: 45%;
        text-align: center;
        vertical-align: top;
    }

    .signature-line {
        margin-top: 5px;
        border-top: 1px solid #000;
        width: 100%;
}

    .witness {
        margin-top: 40px;
    }

    .acknowledgement {
        page-break-before: always;
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: left;
    }

    .no-border td {
        border: none;
    }
</style>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            {{-- @livewire('main.vendor.vendor-create') --}}
            <button class="btn btn-primary" onclick="printReport()">Print</button>
        </div>
        <div class="" id="printable">
            <h3 class="text-center">LEASE CONTRACT OF MARKET STALL</h3>
            
            <p><strong>KNOW ALL MEN BY THESE PRESENTS:</strong></p>
            
            <p class="text-justify">This CONTRACT OF LEASE is made and executed this day of <strong>{{ date('F d, Y') }}</strong>, by and between:</p>
            
            <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $contractSettings->municipality_name }}</strong>, a Local Government Unit represented by <strong>{{ $contractSettings->mayors_name }}</strong>, Municipal Mayor with office address at <strong>{{ $contractSettings->address }}</strong>, hereinafter referred to as the <strong>LESSOR</strong>. </p>
            
            <p style="text-align:center;"><strong>- AND -</strong></p>
            
            <p class="text-justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $contract->stallOccupant->vendor->name }}</strong>, Filipino and with residence and postal address at <strong>{{ $contract->stallOccupant->vendor->address }}</strong>, hereinafter referred to as the <strong>LESSEE</strong>. </p>
            
            <p class="text-center"><strong>WITNESSETH; That</strong></p>
            
            <p class="text-justify">WHEREAS, the LESSOR is the owner of the LEASED PREMISES, commercial units situated at <strong>_____________________________________________________</strong>. </p>
            
            <p class="text-justify">WHEREAS, the LESSOR agrees to lease-out the property to the LESSEE and the LESSEE is willing to lease the same;</p>
            
            <p class="text-justify">NOW THEREFORE, for and in consideration of the foregoing premises, the LESSOR leases unto the LESSEE and the LESSEE hereby accepts from the LESSOR the LEASED premises, subject to the following:</p>
            
            <p class="section-title">TERMS AND CONDITIONS</p>
            
            <p class="text-justify"><strong>1. PURPOSES:</strong> That premises hereby leased shall be used exclusively by the LESSEE for commercial purposes only and shall not be diverted to other uses. It is hereby expressly agreed that if at any time the premises are used for other purposes, the LESSOR shall have the right to rescind this contract without prejudice to its other rights under the law.</p>
            
            <p class="text-justify"><strong>2. TERM:</strong> This term of lease is for THREE (3) YEARS. from _______________________ to _________________________ inclusive. Upon its expiration, this lease may be renewed under such terms and conditions as may be mutually agreed upon by both parties,  written notice of intention to renew the lease shall be served to the LESSOR not later than seven (7) days prior to the expiry date of the period herein agreed upon.</p>
            
            <p class="text-justify"><strong>3. RENTAL RATE:</strong> The monthly rental rate for the leased premises shall be in _________________________________________________(P________________), Philippine Currency. All rental payments shall be made payable to the LESSOR.</p>
            
            <p class="text-justify"><strong>4. PAYMENT OF GOODWILL:</strong> A Goodwill Payment of Thirty Thousand Pesos (P30,000.00) is required to be paid by the LESSEE. The LESSEE shall pay a FIFTEEN THOUSAND PESOS (P15,000.00) upon the awarding of the commercial stall and the remaining fifteen thousand shall be payable within Three (3) Years in equal installments or Four Hundred Twenty Pesos (P420.00) for Thirty Six Months  during the duration of the contract. The goodwill payment is nonrefundable.</p>
            
            <p class="text-justify"><strong>5. DEPOSIT:</strong> That the LESSEE shall deposit to the LESSOR upon signing of this contract and prior to move-in an amount equivalent to the rent for THREE (3) MONTHS or the sum of  Three Thousand Six Hundred Pesos (P 3,600.00), Philippine Currency.  wherein the two (2) months deposit shall be applied as rent for the 59th and 60th  months and the remaining one (1) month deposit shall answer partially for damages and any other obligations, for utilities such as Water, Electricity, CATV, Telephone, Association Dues or resulting from violation(s) of any of the provision of this contract.</p>
            
            <p class="text-justify"><strong>6. DEFAULT PAYMENT:</strong> :  In case of default by the LESSEE in the payment of the rent, such as when the checks are dishonored, the LESSOR at its option may terminate this contract and eject the LESSEE. The LESSOR has the right to padlock the premises when the LESSEE is in default of payment for Three (3) months and may forfeit whatever rental deposit or advances have been given by the LESSEE.</p>
            
            <p class="text-justify"><strong>7. SUB-LEASE:</strong> The LESSEE shall not directly or indirectly sublease, allow or permit the leased premises to be occupied in whole or in part by any person, form or corporation, neither shall the LESSEE assign its rights hereunder to any other person or entity and no right of interest thereto or therein shall be conferred on or vested in anyone by the LESSEE without the LESSOR'S written approval. Violation of such shall cause the ejectment of the LESSEE and the occupant and forfeiture of whatever rental deposit or advances have been given by the LESSEE.</p>
            
            <p class="text-justify"><strong>8. PUBLIC UTILITIES:</strong> The LESSEE shall pay for its telephone, electric, cable TV, water, Internet, association dues and other public services and utilities during the duration of the lease. The LESSEE shall also shoulder for the expenses of connection and maintenance of public utilities in their stall. The public utilities shall be added to the monthly rental of the stall. Nonpayment of utilities for a period of three (3) months shall cause the cancellation of the contract.</p>
            
            <p class="text-justify"><strong>9. FORCE MAJEURE:</strong> If whole or any part of the leased premises shall be destroyed or damaged by fire, flood, lightning, typhoon, earthquake, storm, riot or any other unforeseen disabling cause of acts of God, as to render the leased premises during the term substantially unfit for use and occupation of the LESSEE, then this lease contract may be terminated without compensation by the LESSOR or by the LESSEE by notice in writing to the other.</p>
            
            <p class="text-justify"><strong>10. LESSOR’S RIGHT OF ENTRY:</strong> The LESSOR or its authorized agent shall after giving due notice to the LESSEE shall have the right to enter the premises in the presence of the LESSEE or its representative at any reasonable hour to examine the same or make repairs therein or for the operation and maintenance of the building or to exhibit the leased premises to prospective LESSEE, or for any other lawful purposes which it may deem necessary.</p>
            
            <p class="text-justify"><strong>11. SUBSTANTIAL ALTERATION:</strong> The LESSEE shall not substantially alter the rented premises so as to encroach the other rented stall. Should there be any violation of this, the extension shall be remove at the expense of the LESSEE. The LESSEE shall only be allowed to alter the rented premises so as to prepare the stall ready for the business intended. In case of expiration or non-renewal of lease contract, the LESSEE shall cause the removal of the improvement and return to its original form. Putting up of comfort room in the rented premises is STRICTLY PROHIBITED. Violation of the latter shall be remove by the LESSEE or cause the cancelation of the contract. </p>
            
            <p class="text-justify"><strong>12. EXPIRATION OF LEASE:</strong> At the expiration of the term of this lease or cancellation thereof, as herein provided, the LESSEE will promptly deliver to the LESSOR the leased premises with all corresponding keys and in as good and tenable condition as the same is now, ordinary wear and tear expected devoid of all occupants, movable furniture, articles and effects of any kind. Non-compliance with the terms of this clause by the LESSEE will give the LESSOR the right, at the latter’s option, to refuse to accept the delivery of the premises and compel the LESSEE to pay rent therefrom at the same rate plus Twenty Five (25) % thereof as penalty until the LESSEE shall have complied with the terms hereof.  The same penalty shall be imposed in case the LESSEE fails to leave the premises after the expiration of this Contract of Lease or termination for any reason whatsoever.</p>
            
            <p class="text-justify"><strong>13. JUDICIAL RELIEF:</strong> Should any one of the parties herein be compelled to seek judicial relief against the other, the losing party shall pay an amount of One Hundred (100) % of the amount clamed in the complaint as attorney’s fees which shall in no case be less than P50,000.00 pesos in addition to other cost and damages which the said party may be entitled to under the law.</p>
            
            <p class="text-justify"><strong>14.</strong> This <strong>CONTRACT OF LEASE</strong> shall be valid and binding between the parties, their successors-in-interest and assigns.</p>
            
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>IN WITNESS WHEREOF</strong>, parties herein affixed their signatures on the date and place above written.</p>
            
            <div class="signature-section">
                <div class="signature">
                    <p class="text-center mb-0">{{ $contractSettings->mayors_name }}</p>
                    <div class="signature-line"></div>
                    <strong>LESSOR</strong>
                </div>
            
                <div class="signature" style="float:right;">
                    <p class="text-center mb-0">{{ $contract->stallOccupant->vendor->name }}</p>
                    <div class="signature-line"></div>
                    <strong>LESSEE</strong>
                </div>
            </div>
            
            <div class="witness">
                <p class="text-center">Signed in the presence of:</p>
                <div class="signature-section">
                    <div class="signature">
                        <div class="signature-line"></div>
                    </div>
                    <div class="signature" style="float:right;">
                        <div class="signature-line"></div>
                    </div>
                </div>
            </div>
            
            <div class="acknowledgement" style="page-break-before: always">
                <p class="section-title font-weight-bold text-center">ACKNOWLEDGEMENT</p>
            
                <p>
                    Republic of the Philippines )<br>
                    _________________________ ) S.S.
                </p>
            
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BEFORE ME</strong>, personally appeared:</p>
            
                <table>
                    <tr>
                        <th class="text-center">NAME</th>
                        <th class="text-center">ID NUMBER</th>
                        <th class="text-center">DATE / PLACE ISSUED</th>
                    </tr>
                    <tr>
                        <td>{{ $contractSettings->mayors_name }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>{{ $contract->stallOccupant->vendor->name }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Known to me and to me known to be the same persons who executed the
                    foregoing instrument and acknowledged that the same is their free and 
                    voluntary act and deed.
                </p>
            
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This instrument consisting of ____ page/s, including the page on which this acknowledgement is written, has been signed on each and every page thereof by the concerned parties and their witnesses, and sealed with my notarial seal.
                </p>
            
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WITNESS MY HAND AND SEAL, on the date and place first above written.</p>
            
                <p class="mb-0">Doc. No. ______;</p>
                <p class="mb-0 mt-0">Page No. ______;</p>
                <p class="mb-0 mt-0">Book No. ______;</p>
                <p class="mb-0 mt-0">Series of 20___.</p>
                
            </div>
        </div>
    </div>
    <script>
    function printReport() {
        printJS({
            printable: 'printable',
            type: 'html',
            targetStyles: ['*'],
            style: `
                @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

                body {
                    font-family: 'Roboto', sans-serif;
                }

                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 5px; }
                th { background-color: #f0f0f0; }
                .mb-0 { margin-bottom: 0; }
                .mt-0 { margin-top: 0; }
                .text-center { text-align: center; }
                .text-right { text-align: right; }
                .text-justify { text-align: justify; }
                .font-weight-bold { font-weight: bold; }
                .signature-section {
                    margin-top: 50px;
                    width: 100%;
                }

                .signature {
                    display: inline-block;
                    width: 45%;
                    text-align: center;
                    vertical-align: top;
                }

                .signature-line {
                    margin-top: 5px;
                    border-top: 1px solid #000;
                    width: 100%;
                }

                .witness {
                    margin-top: 40px;
                }
            `
        });
    }
    </script>
</div>
</div>
