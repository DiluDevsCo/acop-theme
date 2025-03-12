const Field = acf.models.SelectField.extend({
  type: 'acf_roles_chooser',
});

acf.registerFieldType( Field );