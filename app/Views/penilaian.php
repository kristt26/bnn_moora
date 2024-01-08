<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div ng-controller="penilaianController">
    <h1 class="h3 mb-4 text-gray-800">{{setTitle}}</h1>
    <div class="row">
        <div class="col-md-12" ng-show="setShow=='client'">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Client</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Clien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. Telepon/HP</th>
                                    <th>Alamat</th>
                                    <th><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas" ng-class="{'bg-primary text-white': item.statusNilai}">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.jk}}</td>
                                    <td>{{item.telp}}</td>
                                    <td>{{item.alamat}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info pmd-ripple-effect btn-sm" ng-click="nilai(item)"><i class="fas fa-file fa-sm fa-fw"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12" ng-show="setShow =='penilaian'">
            <div class="card">
                <div class="card-header d-flex justify-content-lg-between">
                    <h3>Penilaian Client: {{peserta.nama}}</h3>
                    <button class="btn btn-secondary btn-sm" ng-click="back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
                </div>
                <form ng-submit="save()">
                    <div class="card-body">
                        <div class="form-group" ng-repeat="item in model.kriteria">
                            <label>{{item.nama}}</label>
                            <select id="kriteria{{$index}}" class="form-control col-4" ng-options="itemSub as (itemSub.range + ' (' + itemSub.bobot +  ')') for itemSub in item.sub" ng-model="item.value"></select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>