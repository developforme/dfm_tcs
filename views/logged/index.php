	<script>
	  function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	  }
	</script>

	<div class='alert alert-success'>
		<button class='close' data-dismiss='alert'>&times;</button>
		Hello, <strong><?php echo $user["first_name"] . ' ' . $user['last_name']; ?></strong>! Welcome to the admin home page.
	</div>

	<iframe src="calender/index.php/backend" frameborder="0" height="1000" width="100%" scrolling="no" onload="resizeIframe(this)" />Click <a href="calender/index.php/backend">here</a> to view calender.</iframe>
	
                <div class="working-plan-view provider-view" style="display: none">
                    <h3>Working Plan</h3>
                    <button id="reset-working-plan" class="btn btn-primary"
                            title="Reset the working plan back to the default values.">
                        <span class="glyphicon glyphicon-repeat"></span>
                        Reset Plan</button>
                    <table class="working-plan table table-striped">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="monday" />
                                            Monday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="monday-start" class="work-start" /></td>
                                <td><input type="text" id="monday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="tuesday" />
                                            Tuesday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="tuesday-start" class="work-start" /></td>
                                <td><input type="text" id="tuesday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="wednesday" />
                                            Wednesday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="wednesday-start" class="work-start" /></td>
                                <td><input type="text" id="wednesday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="thursday" />
                                            Thursday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="thursday-start" class="work-start" /></td>
                                <td><input type="text" id="thursday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="friday" />
                                            Friday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="friday-start" class="work-start" /></td>
                                <td><input type="text" id="friday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="saturday" />
                                            Saturday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="saturday-start" class="work-start" /></td>
                                <td><input type="text" id="saturday-end" class="work-end" /></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="sunday" />
                                            Sunday</label>
                                    </div>
                                </td>
                                <td><input type="text" id="sunday-start" class="work-start" /></td>
                                <td><input type="text" id="sunday-end" class="work-end" /></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>

                    <h3>Breaks</h3>

                    <span class="help-block">
                        Add the working breaks during each day. During breaks the site will not accept any allocations.
                    </span>

                    <div>
                        <button type="button" class="add-break btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add Break
                        </button>
                    </div>

                    <br>

                    <table class="breaks table table-striped">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th><Start</th>
                                <th>End</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
	
	
	<div style="margin-bottom: 50px"></div>