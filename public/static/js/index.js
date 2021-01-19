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
      moveGroup:'',
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
          for(let i = 0; i < this.group.students.length; i++) {
            for(let j = 0; j < this.selectedStudents.length; j++){
              if(this.selectedStudents[j].id === this.group.students[i].id){
                this.$delete(this.group.students[i], 'timelines');
              }
            }
          }
          console.log(this.group.students);
          this.selectedStudents = [];
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
          this.selectedStudents = [];
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
        this.groups[i].value = this.groups[i].name;
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