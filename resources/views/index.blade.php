@extends('master')

@section('head')
@stop
@section('content')
<div id='index'>
  <q-layout view="lHh lpr lFf" container>
    <q-header>
      <q-toolbar>
        <q-avatar>
          <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
        </q-avatar>

        <q-toolbar-title>MKP Project</q-toolbar-title>

      </q-toolbar>
    </q-header>

    <q-footer>
      <q-toolbar>
        © VSTU
      </q-toolbar>
    </q-footer>

    <q-page-container >
      <q-page class="q-pa-md">
        <q-table
          no-data-label="Загрузка информации из базы данных"
          selection="multiple"
          rows-per-page-label="Студентов на странице"
          :data="group.students"
          :columns="groupColumns"
          :selected.sync="selectedStudents"
        >
          <template v-slot:top>
            <p class="text-h6">Вот здесь работаем с группами</p>
            <q-space></q-space>
            <q-select
              standout
              rounded
              v-model="group"
              :options="groups"
            />
          </template>
        </q-table>
      </q-page>
    </q-page-container>
  </q-layout>
</div>
@stop
@section('scripts')
  <script src=" {{asset('static/js/index.js')}}"></script>
@stop