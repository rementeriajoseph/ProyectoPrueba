<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ViewEnrollments Model
 *
 * @property \App\Model\Table\EnrollmentsTable|\Cake\ORM\Association\BelongsTo $Enrollments
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\SubjectsTable|\Cake\ORM\Association\BelongsTo $Subjects
 *
 * @method \App\Model\Entity\ViewEnrollment get($primaryKey, $options = [])
 * @method \App\Model\Entity\ViewEnrollment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ViewEnrollment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ViewEnrollment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ViewEnrollment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ViewEnrollment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ViewEnrollment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ViewEnrollment findOrCreate($search, callable $callback = null, $options = [])
 */
class ViewEnrollmentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('view_enrollments');

        $this->belongsTo('Enrollments', [
            'foreignKey' => 'enrollments_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->decimal('grade')
            ->allowEmpty('grade');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['enrollments_id'], 'Enrollments'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));

        return $rules;
    }

    /**
     * I don't know what I'm doing XD.
     * 
     * @param x $id I don't know XD.
     * @return y niether.
     */
    public function getViewEnrollments($id)
    {

        $r = $this->find()
        ->where(['enrollments_id'=>$id])
        ->toList();
        /**
         * La consulta anterior devuelve un vector de objetos,
         * nos interesa el primer elemento.
         */
        return $r[0];
    }
}
