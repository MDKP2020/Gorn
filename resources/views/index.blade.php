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
        <q-space></q-space>
        © VSTU, 2021
        <q-space></q-space>
      </q-toolbar>
    </q-footer>

    <q-page-container >
      <q-page class="q-pa-md">
        <q-table
          no-data-label="Выберите группу для начала работы"
          :pagination.sync="tablePagination"
          :selected-rows-label="(numberOfRows) => numberOfRows+' студентов выбрано'"
          rows-per-page-label="Студентов на странице"
          row-key="id"
          :data="group.students"
          :columns="groupColumns"
          selection="multiple"
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
        <q-btn-group spread>
          <q-btn
            push
            icon="not_accessible"
            label="Отчислить"
            color="primary"
            @click="deleteStudents"
          >
          </q-btn>
          <q-btn
            push
            icon="accessible"
            label="Перевести в др. группу"
            color="primary"
            @click="move=!move"
          >
          </q-btn>
          <q-btn
            push
            label="Перевести на след. курс"
            icon="accessible_forward"
            color="primary"
            @click="upgradeStudents"
          >
          </q-btn>
        </q-btn-group>
        <q-dialog v-model="move">
          <q-card>
            <q-toolbar>
                  <q-toolbar-title>
                    Перевод в другую группу
                  </q-toolbar-title>
                  <q-btn flat round dense icon="close" v-close-popup />
            </q-toolbar>
            <q-card-section>
              <q-input
                :rules="[val => !!val,
                val => !isNaN(val)]"
                lazy-rules
                label="Название группы"
                v-model="moveGroup" 
              >
              </q-input>
            </q-card-section>
            <q-card-actions>
              <q-btn
                flat
                v-close-popup
              >
                Отмена
              </q-btn>
              <q-btn 
                @click="" 
                color="black" 
              >
                Перевести
              </q-btn>
            </q-card-actions>
          </q-card>
        </q-dialog>
      </q-page>
    </q-page-container>
  </q-layout>
</div>
@stop
@section('scripts')
  <script src=" {{asset('static/js/index.js')}}"></script>
@stop