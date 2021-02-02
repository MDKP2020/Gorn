'use strict';

new Vue({
  el: '#index',
  data: function() {
    return {
      group: {
        value: '',
        label: 'Выберите группу',
        students: [],
      },
      groups: [],
      groupColumns: [
        {
          name: 'name',
          label: 'ФИО студента',
          field: 'name'
        },
        {
          name: 'id',
          label: 'Номер зачётной книжки',
          field: 'id'
        }
      ],
      move: false,
      moveGroup: {
        value: '',
        label: 'Выберите группу',
        students: [],
      },
      selectedStudents: [],
      tablePagination: {
        rowsPerPage: 15
      }
    }
  },
  methods: {
    deleteStudents: function() {
      axios.post('students/delete', {
        'student_ids': this.selectedStudents
      })
      .then(ans => {
        if(ans.status !== 200)
          this.$q.notify({
            message:
              'Возникла ошибка на стороне сервера',
            position: 'top',
            textColor: 'white'
          });
        else {
          for(let j = 0; j < this.selectedStudents.length; j++){
            for(let i = 0; i < this.group.students.length; i++) {
              if(this.selectedStudents[j].id === this.group.students[i].id){
                this.group.students = [ ...this.group.students.slice(0, i), ...this.group.students.slice(i + 1) ]
                break;
              }
            }
          }
          this.selectedStudents = [];
        }
      })
    },
    moveStudents: function() {
      axios.post('students/move', {
        'student_ids': this.selectedStudents,
        'group_id': this.moveGroup.id
      })
      .then(ans => {
        if(ans.status !== 200)
          this.$q.notify({
            message:
              'Возникла ошибка на стороне сервера',
            position: 'top',
            textColor: 'white'
          });
        else {
          windows.location.reload();
        }
      })
    },
    upgradeStudents: function() {
      axios.post('students/upgrade', {
        'student_ids': this.selectedStudents
      })
      .then(ans => {
        if(ans.status !== 200)
          this.$q.notify({
            message:
              'Возникла ошибка на стороне сервера',
            position: 'top',
            textColor: 'white'
          });
        else {
          windows.location.reload();
        }
      })
    }
  },
  mounted() {
    axios.get('groups/get')
    .then(ans => {
      this.groups = ans.data;
      for(let i = 0; i < this.groups.length; i++){
        this.groups[i].label = this.groups[i].name;
        this.groups[i].id = this.groups[i].id;
        axios.get('students/get/'+this.groups[i].id)
        .then(ans => {
          if(ans.status === 200)
            this.groups[i].students = ans.data;
          else
            this.$q.notify({
              message:
                'Возникла ошибка на стороне сервера',
              position: 'top',
              textColor: 'white'
            });
        })
      }
    });
  }
});