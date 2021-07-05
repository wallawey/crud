/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package training.springmvc.crud.dao;

import java.util.List;
import org.springframework.orm.hibernate3.support.HibernateDaoSupport;
import training.springmvc.crud.model.Person;

/**
 * 
 * @author henri
 */
public class PersonDAOHib extends HibernateDaoSupport implements PersonDAO{

    public List getPersonList(){
        return getHibernateTemplate().find("from Person");
    }

    public Person getPerson(Long id){
        return (Person) getHibernateTemplate().get(Person.class, id);
    }

    public void savePerson(Person person){
        this.getHibernateTemplate().saveOrUpdate(person);
    }

    public void deletePerson(Long id){
        getHibernateTemplate().delete(getPerson(id));
    }
}