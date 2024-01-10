<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div ng-controller="hasilController">
    <h1 class="h3 mb-4 text-gray-800">{{setTitle}}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Hasil Analisa</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.alternatif">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.preferensi}}</td>
                                    <td>{{item.preferensi>=0.1 ? 'Wajib Rehabilitas' : 'Tidak Wajib Rehabilitas'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>