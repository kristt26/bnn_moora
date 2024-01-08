<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div ng-controller="rangeController">
    <h1 class="h3 mb-4 text-gray-800">{{setTitle}}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Input Data Sub Kriteria</h3>
                </div>
                <form ng-submit="save()">
                    <div class="card-body">
                        <div ng-class="{'form-group pmd-textfield pmd-textfield-floating-label': !model.id, 'form-group pmd-textfield': model.id}">
                            <label class="control-label">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama" ng-model="model.nama" required>
                        </div>
                        <div ng-class="{'form-group pmd-textfield pmd-textfield-floating-label': !model.id, 'form-group pmd-textfield': model.id}">
                            <label class="control-label">Kode</label>
                            <input type="text" class="form-control" ng-model="model.kode" required>
                        </div>
                        <div ng-class="{'form-group pmd-textfield pmd-textfield-floating-label': !model.id, 'form-group pmd-textfield': model.id}">
                            <label class="control-label">Bobot</label>
                            <input type="number" class="form-control" ng-model="model.bobot" placeholder="Bobot dalam %" required>
                        </div>
                        <div ng-class="{'form-group pmd-textfield pmd-textfield-floating-label': !model.id, 'form-group pmd-textfield': model.id}">
                            <label class="control-label">Type</label>
                            <select class="form-control" ng-model="model.type">
                                <option value="Benefits">Benefits</option>
                                <option value="Cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary pmd-ripple-effect btn-sm">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Kriteria</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Bobot</th>
                                    <th>Type</th>
                                    <th><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.kode}}</td>
                                    <td>{{item.bobot}}</td>
                                    <td>{{item.type}}</td>
                                    <td>
                                        <button type="submit" class="btn btn-warning pmd-ripple-effect btn-sm" ng-click="edit(item)"><i class="fas fa-edit fa-sm fa-fw"></i></button>
                                        <button type="submit" class="btn btn-danger pmd-ripple-effect btn-sm"><i class="fas fa-trash-alt fa-sm fa-fw"></i></button>
                                        <button type="submit" class="btn btn-primary pmd-ripple-effect btn-sm"><i class="fas fa-list"></i></button>
                                    </td>
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