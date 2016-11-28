<div id="jtFindAndReplaceModal" class="jtmodal">
    
  <!-- Modal content -->
  <div class="jtmodal-content">
    <div class="jtmodal-header">
      <span class="jtclose">×</span>
      <h2><?php _e('Find And Replace',$text_domain); ?></h2>
    </div>
    <div class="jtmodal-body">
      <p><?php _e('Use this to feature to search and replace text in your table.',$text_domain); ?></p>
      <table>
          <tbody>
              <tr>
                  <td><label><?php _e('Find:',$text_domain); ?></label></td>
                  <td><input type="text" id="jtfindandreplacefind"></td>
              </tr>
              <tr>
                  <td><label><?php _e('Replace:',$text_domain); ?></label></td>
                  <td><input type="text" id="jtfindandreplacereplace"></td>
              </tr>
              <tr><td></td><td><button><?php _e('Replace',$text_domain); ?></button></td></tr>
          </tbody>
      </table>
    </div>
  </div>

</div>

<div id="jtlinkModal" class="jtmodal">
    
  <!-- Modal content -->
  <div class="jtmodal-content">
    <div class="jtmodal-header">
      <span class="jtclose">×</span>
      <h2><?php _e('Insert a link',$text_domain); ?></h2>
    </div>
    <div class="jtmodal-body">
      <p><?php _e('This will wrap your current cell data inside a link tag',$text_domain); ?></p>
      <table>
          <tbody>
              <tr>
                  <td><label><?php _e('Link:',$text_domain); ?></label></td>
                  <td><input type="text" id="jtlink"></td>
              </tr>
              <tr><td></td><td><button><?php _e('Insert',$text_domain); ?></button></td></tr>
          </tbody>
      </table>
    </div>
  </div>