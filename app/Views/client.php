<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div ng-controller="clientController">
    <h1 class="h3 mb-4 text-gray-800">{{setTitle}}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Input Data Client</h3>
                </div>
                <form ng-submit="save()">
                    <div class="card-body">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Nama</label>
                            <input type="text" class="form-control" id="nama" ng-model="model.nama" required>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Jenis Kelamin</label>
                            <select class="form-control" ng-model="model.jk">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Telepon/Hp</label>
                            <input type="text" class="form-control" id="telp" ng-model="model.telp" required>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Alamat</label>
                            <textarea rows="3" class="form-control" ng-model="model.alamat">Alamat</textarea>
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
                    <h3>Daftar Client</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table pmd-table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telp/HP</th>
                                    <th>Alamat</th>
                                    <th><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.jk}}</td>
                                    <td>{{item.telp}}</td>
                                    <td>{{item.alamat}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning pmd-ripple-effect btn-sm" ng-click="edit(item)"><i class="fas fa-edit fa-sm fa-fw"></i></button>
                                        <button type="button" class="btn btn-danger pmd-ripple-effect btn-sm" ng-click="delete(item)"><i class="fas fa-trash-alt fa-sm fa-fw"></i></button>
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