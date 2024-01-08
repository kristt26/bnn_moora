<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div ng-controller="alternatifController">
    <h1 class="h3 mb-4 text-gray-800">{{setTitle}}</h1>
    <div class="row">
        <div class="col-md-12" ng-show="setShow=='select'">
            <div class="card">
                <div class="card-header">
                    <h3>Data Alternatif tidak inputkan secara manual tetapi langsung dimport menggunakan format excel. silahkan download format excel di <a href="<?= base_url('format_alternatif.xlsx') ?>">sini</a></h3>
                </div>
                <form ng-submit="save()">
                    <div class="card-body">
                        <div ng-class="{'form-group pmd-textfield pmd-textfield-floating-label': !model.id, 'form-group pmd-textfield': model.id}">
                            <label class="control-label">File Excel</label>
                            <input type="file" class="form-control" name="berkas" ng-change="getData(berkas)" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="berkas" ng-model="berkas" base-sixty-four-input required>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card" ng-show="dataExcel.length>0">
                <div class="card-header d-flex justify-content-lg-between">
                    <h3>Data Excel</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th ng-repeat="item in dataExcel[0].nilai">C{{$index+1}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataExcel">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.kode}}</td>
                                    <td ng-repeat="nilai in item.nilai">{{nilai.value}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" ng-click="next()" class="btn btn-primary pmd-ripple-effect btn-sm"><i class="fa fa-arrow-right" aria-hidden="true"></i>Lanjut</button>
                </div>
            </div>
        </div>
        <div class="col-md-12" ng-show="setShow=='data'">
            <div class="card">
                <div class="card-header d-flex justify-content-lg-between">
                    <h3>Matriks Keputusan</h3>
                    <button class="btn btn-secondary btn-sm" ng-click="back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th ng-repeat="item in dataExcel[0].nilai">C{{$index+1}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataExcel">
                                    <td>{{item.kode}}</td>
                                    <td ng-repeat="nilai in item.nilai">{{nilai.bobot}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" ng-click="save()" class="btn btn-primary pmd-ripple-effect btn-sm"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>