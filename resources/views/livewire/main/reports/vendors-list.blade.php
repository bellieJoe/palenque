<div>
    <x-page-header title="Vendors/Stall Holders Masterlist" />
    <div class="d-flex justify-content-end mb-3">
        {{-- @livewire('main.vendor.vendor-create') --}}
        <button class="btn btn-primary" onclick="printVendors()">Print</button>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="printable">
                <h3 class="text-center">Vendors/Stallholders Masterlist</h3>
                <p class="text-center">{{ date('F d, Y') }}</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" style="min-width: 1000px">
                        <thead>
                            <th>Name</th>
                            <th class="">Representative</th>
                            <th class="text-center">Contact Number</th>
                            <th class="text-center">Email</th>
                        </thead>
                        <tbody>
                            @forelse ($vendors as $vendor)
                                <tr>
                                    <td class="align-middle">{{ $vendor->name }}</td>
                                    <td class="align-middle ">{{ $vendor->representative_name }}</td>
                                    <td class="align-middle text-center">{{ $vendor->contact_number }}</td>
                                    <td class="align-middle text-center">{{ $vendor->user->email }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No Vendors Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    function printVendors() {
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
                h3, p { text-align: center; }
            `
        });
    }
    </script>
</div>
