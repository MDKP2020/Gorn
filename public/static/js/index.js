'use strict';

new Vue({
  el: '#index',
  data: function() {
    return {
      group: {
        value: '',
        label: 'Выберите группу',
        students: []
      },
      groups: [
        // {
        //   label: 'ПрИн-466',
        //   students: [
        //     { 
        //       id: 1,
        //       name: 'пупа из 466',
        //     },
        //     { 
        //       id: 2,
        //       name: 'лупа из 466',
        //     },
        //   ]
        // },
        // {
        //   label: 'ПрИн-467',
          // students: [
          //   { 
          //     id: 1,
          //     name: 'пупа из 467',
          //   },
          //   { 
          //     id: 2,
          //     name: 'лупа из 467',
          //   },
          // ]
        // }
      ],
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
      selectedStudents: [],
    }
  },
  methods: {

  },
  mounted() {
    axios.get('groups/get')
    .then(ans => {
      this.groups = ans.data;
      for(let i = 0; i < this.groups.length; i++){
        this.groups[i].label = this.groups[i].name;
        this.groups[i].value = this.groups[i].name;
        axios.get('students/get')
        .then(ans => {
          this.groups[i].students = ans.data;
        })
      }
    });
  }
});