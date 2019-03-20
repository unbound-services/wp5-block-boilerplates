import './template.backend.scss' // only shows up in the backend
import './template.frontend.scss' // shows up backend and front end
import './template.scss' // shows up backend and front end

wp.blocks.registerBlockType('group/blockname', {
  title: 'blockname',
  icon: 'carrot',
  category: 'block_category',
  attributes: {
    title: {type: 'string'},
    version:{
      type:'integer',
      default:0
    }
  },
  edit: function(props){
    function updateTitle(event){

      props.setAttributes({title: event.target.value});
    }



    return (
      <div>Template/Demo Custom Block
        {props.attributes.title}
        <input type='text' value={props.attributes.title} onChange = {updateTitle} />
      </div>
    )
  },
  save: function(props){
    switch (props.version) {
      default:
      return
      <div className=''>
        {props.attributes.title}
      </div>;

    }

  }
})
