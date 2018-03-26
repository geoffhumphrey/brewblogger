<?php
//$_SESSION['measTemp'] = "C";
function f_to_c($temp_pref,$temp) {
      if ($temp_pref == "C") {
            return number_format((($temp - 32) / (9/5)),1);
      }
      else return $temp;
}
?>

<script>
$(document).ready(function() {
    $('#carbChart').DataTable( {
      "scrollX": true,
	"paging": false,
	"lengthChange": false,
	"ordering": false,
	"dom": 't'
    } );
} );
</script>
<h2>Carbonation Chart</h2>
<table class="table table-striped">
      <thead>
            <tr>
                  <th width="30%">Type</th>
                  <th width="15%">CO2 (Vols)</th>

                  <th width="30%">Type</th>
                  <th width="15%">CO2 (Vols)</th>
            </tr>
      </thead>
      <tbody>
            <tr>
                <td>English Ales</td>
                <td>1.5 - 2.0</td>

                <td>European Lagers</td>
                <td>2.2 - 2.7</td>
            </tr>
            <tr>
                <td>Stout/Porter</td>
                <td>1.7 - 2.3</td>

                <td>American Ales/Lagers</td>
                <td>2.2 - 2.7</td>
            </tr>
            <tr>
                <td>Belgian Ales</td>
                <td>1.9 - 2.4</td>
                <td>Lambic</td>
                <td>2.4 - 2.8</td>
            </tr>
            <tr>
                <td>Wheat Beer</td>
                <td>3.3 - 4.5</td>
                <td>Fruit Lambic</td>
                <td>3.0 - 4.5</td>
            </tr>
      </tbody>
</table>
<table id="carbChart" class="table table-striped table-bordered small">
    <thead>
    <tr>
      <th>&nbsp;</th>
      <th>1 PSI</th>
      <th>2 PSI</th>
      <th>3 PSI</th>
      <th>4 PSI</th>
      <th>5 PSI</th>
      <th>6 PSI</th>
      <th>7 PSI</th>
      <th>8 PSI</th>
      <th>9 PSI</th>
      <th>10 PSI</th>
      <th>11 PSI</th>
      <th>12 PSI</th>
      <th>13 PSI</th>
      <th>14 PSI</th>
      <th>15 PSI</th>
      <th>16 PSI</th>
      <th>17 PSI</th>
      <th>18 PSI</th>
      <th>19 PSI</th>
      <th>20 PSI</th>
      <th>21 PSI</th>
      <th>22 PSI</th>
      <th>23 PSI</th>
      <th>24 PSI</th>
      <th>25 PSI</th>
      <th>26 PSI</th>
      <th>27 PSI</th>
      <th>28 PSI</th>
      <th>29 PSI</th>
      <th>30 PSI</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],30)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.82</td>
      <td>1.92</td>
      <td>2.03</td>
      <td>2.14</td>
      <td>2.23</td>
      <td>2.36</td>
      <td>2.48</td>
      <td>2.60</td>
      <td>2.70</td>
      <td>2.82</td>
      <td>2.93</td>
      <td>3.02</td>
      <td>3.13</td>
      <td>3.24</td>
      <td>3.35</td>
      <td>3.46</td>
      <td>3.57</td>
      <td>3.67</td>
      <td>3.78</td>
      <td>3.89</td>
      <td>4.00</td>
      <td>4.11</td>
      <td>4.22</td>
      <td>4.33</td>
      <td>4.44</td>
      <td>4.55</td>
      <td>4.66</td>
      <td>4.77</td>
      <td>4.87</td>
      <td>4.98</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],31)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.78</td>
      <td>1.88</td>
      <td>2.00</td>
      <td>2.10</td>
      <td>2.20</td>
      <td>2.31</td>
      <td>2.42</td>
      <td>2.54</td>
      <td>2.65</td>
      <td>2.76</td>
      <td>2.86</td>
      <td>2.96</td>
      <td>3.07</td>
      <td>3.17</td>
      <td>3.28</td>
      <td>3.39</td>
      <td>3.50</td>
      <td>3.60</td>
      <td>3.71</td>
      <td>3.82</td>
      <td>3.93</td>
      <td>4.03</td>
      <td>4.14</td>
      <td>4.25</td>
      <td>4.35</td>
      <td>4.46</td>
      <td>4.57</td>
      <td>4.68</td>
      <td>4.78</td>
      <td>4.89</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],32)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.75</td>
      <td>1.85</td>
      <td>1.95</td>
      <td>2.05</td>
      <td>2.15</td>
      <td>2.27</td>
      <td>2.38</td>
      <td>2.48</td>
      <td>2.59</td>
      <td>2.70</td>
      <td>2.80</td>
      <td>2.90</td>
      <td>3.00</td>
      <td>3.11</td>
      <td>3.21</td>
      <td>3.31</td>
      <td>3.42</td>
      <td>3.52</td>
      <td>3.63</td>
      <td>3.73</td>
      <td>3.84</td>
      <td>3.94</td>
      <td>4.04</td>
      <td>4.15</td>
      <td>4.25</td>
      <td>4.36</td>
      <td>4.46</td>
      <td>4.57</td>
      <td>4.67</td>
      <td>4.77</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],33)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.71</td>
      <td>1.81</td>
      <td>1.91</td>
      <td>2.01</td>
      <td>2.10</td>
      <td>2.23</td>
      <td>2.33</td>
      <td>2.43</td>
      <td>2.53</td>
      <td>2.63</td>
      <td>2.74</td>
      <td>2.84</td>
      <td>2.96</td>
      <td>3.06</td>
      <td>3.15</td>
      <td>3.25</td>
      <td>3.35</td>
      <td>3.46</td>
      <td>3.56</td>
      <td>3.66</td>
      <td>3.76</td>
      <td>3.87</td>
      <td>3.97</td>
      <td>4.07</td>
      <td>4.18</td>
      <td>4.28</td>
      <td>4.38</td>
      <td>4.48</td>
      <td>4.59</td>
      <td>4.69</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],34)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.68</td>
      <td>1.78</td>
      <td>1.86</td>
      <td>1.97</td>
      <td>2.06</td>
      <td>2.18</td>
      <td>2.28</td>
      <td>2.38</td>
      <td>2.48</td>
      <td>2.58</td>
      <td>2.69</td>
      <td>2.79</td>
      <td>2.90</td>
      <td>3.00</td>
      <td>3.09</td>
      <td>3.19</td>
      <td>3.29</td>
      <td>3.39</td>
      <td>3.49</td>
      <td>3.59</td>
      <td>3.69</td>
      <td>3.79</td>
      <td>3.90</td>
      <td>4.00</td>
      <td>4.10</td>
      <td>4.20</td>
      <td>4.30</td>
      <td>4.40</td>
      <td>4.50</td>
      <td>4.60</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],35)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.63</td>
      <td>1.73</td>
      <td>1.83</td>
      <td>1.93</td>
      <td>2.02</td>
      <td>2.14</td>
      <td>2.24</td>
      <td>2.34</td>
      <td>2.43</td>
      <td>2.52</td>
      <td>2.63</td>
      <td>2.73</td>
      <td>2.83</td>
      <td>2.93</td>
      <td>3.02</td>
      <td>3.12</td>
      <td>3.22</td>
      <td>3.32</td>
      <td>3.42</td>
      <td>3.52</td>
      <td>3.62</td>
      <td>3.72</td>
      <td>3.82</td>
      <td>3.92</td>
      <td>4.01</td>
      <td>4.11</td>
      <td>4.21</td>
      <td>4.31</td>
      <td>4.41</td>
      <td>4.51</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],36)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.60</td>
      <td>1.69</td>
      <td>1.79</td>
      <td>1.88</td>
      <td>1.98</td>
      <td>2.09</td>
      <td>2.19</td>
      <td>2.29</td>
      <td>2.38</td>
      <td>2.47</td>
      <td>2.57</td>
      <td>2.67</td>
      <td>2.77</td>
      <td>2.86</td>
      <td>2.96</td>
      <td>3.05</td>
      <td>3.15</td>
      <td>3.24</td>
      <td>3.34</td>
      <td>3.43</td>
      <td>3.53</td>
      <td>3.63</td>
      <td>3.72</td>
      <td>3.82</td>
      <td>3.92</td>
      <td>4.01</td>
      <td>4.11</td>
      <td>4.21</td>
      <td>4.30</td>
      <td>4.40</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],37)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.55</td>
      <td>1.65</td>
      <td>1.74</td>
      <td>1.84</td>
      <td>1.94</td>
      <td>2.04</td>
      <td>2.14</td>
      <td>2.24</td>
      <td>2.33</td>
      <td>2.42</td>
      <td>2.52</td>
      <td>2.62</td>
      <td>2.71</td>
      <td>2.80</td>
      <td>2.90</td>
      <td>3.00</td>
      <td>3.09</td>
      <td>3.18</td>
      <td>3.27</td>
      <td>3.37</td>
      <td>3.46</td>
      <td>3.56</td>
      <td>3.65</td>
      <td>3.75</td>
      <td>3.84</td>
     <td>3.94</td>
      <td>4.03</td>
      <td>4.13</td>
      <td>4.22</td>
      <td>4.32</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],38)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.52</td>
      <td>1.61</td>
      <td>1.71</td>
      <td>1.80</td>
      <td>1.90</td>
      <td>2.00</td>
      <td>2.10</td>
      <td>2.20</td>
      <td>2.29</td>
      <td>2.38</td>
      <td>2.48</td>
      <td>2.57</td>
      <td>2.66</td>
      <td>2.75</td>
      <td>2.85</td>
      <td>2.94</td>
      <td>3.03</td>
      <td>3.12</td>
      <td>3.21</td>
      <td>3.30</td>
      <td>3.40</td>
      <td>3.49</td>
      <td>3.59</td>
      <td>3.68</td>
      <td>3.77</td>
      <td>3.87</td>
      <td>3.96</td>
      <td>4.06</td>
      <td>4.15</td>
      <td>4.24</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],39)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.49</td>
      <td>1.58</td>
      <td>1.67</td>
      <td>1.77</td>
      <td>1.86</td>
      <td>1.96</td>
      <td>2.06</td>
      <td>2.15</td>
      <td>2.25</td>
      <td>2.34</td>
      <td>2.43</td>
      <td>2.52</td>
      <td>2.61</td>
      <td>2.70</td>
      <td>2.80</td>
      <td>2.89</td>
      <td>2.98</td>
      <td>3.07</td>
      <td>3.16</td>
      <td>3.25</td>
      <td>3.34</td>
      <td>3.44</td>
      <td>3.53</td>
      <td>3.62</td>
      <td>3.71</td>
      <td>3.81</td>
      <td>3.90</td>
      <td>3.99</td>
      <td>4.08</td>
      <td>4.18</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],40)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.47</td>
      <td>1.56</td>
      <td>1.65</td>
      <td>1.74</td>
      <td>1.83</td>
      <td>1.92</td>
      <td>2.01</td>
      <td>2.10</td>
      <td>2.20</td>
      <td>2.30</td>
      <td>2.39</td>
      <td>2.47</td>
      <td>2.56</td>
      <td>2.65</td>
      <td>2.75</td>
      <td>2.84</td>
      <td>2.93</td>
      <td>3.01</td>
      <td>3.10</td>
      <td>3.19</td>
      <td>3.28</td>
      <td>3.37</td>
      <td>3.46</td>
      <td>3.55</td>
      <td>3.64</td>
      <td>3.73</td>
      <td>3.82</td>
      <td>3.91</td>
      <td>4.01</td>
      <td>4.10</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],41)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.43</td>
      <td>1.52</td>
      <td>1.61</td>
      <td>1.70</td>
      <td>1.79</td>
      <td>1.88</td>
      <td>1.97</td>
      <td>2.06</td>
      <td>2.16</td>
      <td>2.25</td>
      <td>2.34</td>
      <td>2.43</td>
      <td>2.52</td>
      <td>2.60</td>
      <td>2.70</td>
      <td>2.79</td>
      <td>2.88</td>
      <td>2.96</td>
      <td>3.05</td>
      <td>3.14</td>
      <td>3.23</td>
      <td>3.32</td>
      <td>3.41</td>
      <td>3.50</td>
      <td>3.59</td>
      <td>3.68</td>
      <td>3.77</td>
      <td>3.86</td>
      <td>3.95</td>
      <td>4.04</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],42)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.39</td>
      <td>1.48</td>
      <td>1.57</td>
      <td>1.66</td>
      <td>1.75</td>
      <td>1.85</td>
      <td>1.94</td>
      <td>2.02</td>
      <td>2.12</td>
      <td>2.21</td>
      <td>2.30</td>
      <td>2.39</td>
      <td>2.48</td>
      <td>2.56</td>
      <td>2.65</td>
      <td>2.74</td>
      <td>2.83</td>
      <td>2.91</td>
      <td>3.00</td>
      <td>3.09</td>
      <td>3.18</td>
      <td>3.26</td>
      <td>3.35</td>
      <td>3.44</td>
      <td>3.53</td>
      <td>3.62</td>
      <td>3.70</td>
      <td>3.79</td>
      <td>3.88</td>
      <td>3.97</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],43)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.37</td>
      <td>1.46</td>
      <td>1.54</td>
      <td>1.63</td>
      <td>1.72</td>
      <td>1.81</td>
      <td>1.90</td>
      <td>1.99</td>
      <td>2.08</td>
      <td>2.17</td>
      <td>2.26</td>
      <td>2.34</td>
      <td>2.43</td>
      <td>2.52</td>
      <td>2.61</td>
      <td>2.69</td>
      <td>2.78</td>
      <td>2.86</td>
      <td>2.95</td>
      <td>3.04</td>
      <td>3.13</td>
      <td>3.21</td>
      <td>3.30</td>
      <td>3.39</td>
      <td>3.47</td>
      <td>3.56</td>
      <td>3.65</td>
      <td>3.74</td>
      <td>3.82</td>
      <td>3.91</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],44)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.35</td>
      <td>1.43</td>
      <td>1.52</td>
      <td>1.60</td>
      <td>1.69</td>
      <td>1.78</td>
      <td>1.87</td>
      <td>1.95</td>
      <td>2.04</td>
      <td>2.13</td>
      <td>2.22</td>
      <td>2.30</td>
      <td>2.39</td>
      <td>2.47</td>
      <td>2.56</td>
      <td>2.64</td>
      <td>2.73</td>
      <td>2.81</td>
      <td>2.90</td>
      <td>2.99</td>
      <td>3.07</td>
      <td>3.10</td>
      <td>3.24</td>
      <td>3.33</td>
      <td>3.41</td>
      <td>3.50</td>
      <td>3.58</td>
      <td>3.67</td>
      <td>3.76</td>
      <td>3.84</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],45)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.32</td>
      <td>1.41</td>
      <td>1.49</td>
      <td>1.58</td>
      <td>1.66</td>
      <td>1.75</td>
      <td>1.84</td>
      <td>1.91</td>
      <td>2.00</td>
      <td>2.08</td>
      <td>2.17</td>
      <td>2.26</td>
      <td>2.34</td>
      <td>2.42</td>
      <td>2.51</td>
      <td>2.60</td>
      <td>2.69</td>
      <td>2.77</td>
      <td>2.86</td>
      <td>2.94</td>
      <td>3.02</td>
      <td>3.11</td>
      <td>3.19</td>
      <td>3.28</td>
      <td>3.36</td>
      <td>3.45</td>
      <td>3.53</td>
      <td>3.62</td>
      <td>3.70</td>
      <td>3.79</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],46)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.28</td>
      <td>1.37</td>
      <td>1.45</td>
      <td>1.54</td>
      <td>1.62</td>
      <td>1.71</td>
      <td>1.80</td>
      <td>1.88</td>
      <td>1.96</td>
      <td>2.04</td>
      <td>2.13</td>
      <td>2.22</td>
      <td>2.30</td>
      <td>2.38</td>
      <td>2.47</td>
      <td>2.55</td>
      <td>2.64</td>
      <td>2.72</td>
      <td>2.81</td>
      <td>2.89</td>
      <td>2.98</td>
      <td>3.06</td>
      <td>3.15</td>
      <td>3.23</td>
      <td>3.31</td>
      <td>3.40</td>
      <td>3.48</td>
      <td>3.57</td>
      <td>3.65</td>
      <td>3.74</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],47)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.26</td>
      <td>1.34</td>
      <td>1.42</td>
      <td>1.51</td>
      <td>1.59</td>
      <td>1.68</td>
      <td>1.76</td>
      <td>1.84</td>
      <td>1.92</td>
      <td>2.00</td>
      <td>2.09</td>
      <td>2.18</td>
      <td>2.26</td>
      <td>2.34</td>
      <td>2.42</td>
      <td>2.50</td>
      <td>2.59</td>
      <td>2.67</td>
      <td>2.76</td>
      <td>2.84</td>
      <td>2.93</td>
      <td>3.02</td>
      <td>3.09</td>
      <td>3.18</td>
      <td>3.26</td>
      <td>3.35</td>
      <td>3.43</td>
      <td>3.51</td>
      <td>3.60</td>
      <td>3.68</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],48)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.23</td>
      <td>1.31</td>
      <td>1.39</td>
      <td>1.48</td>
      <td>1.56</td>
      <td>1.65</td>
      <td>1.73</td>
      <td>1.81</td>
      <td>1.89</td>
      <td>1.96</td>
      <td>2.05</td>
      <td>2.14</td>
      <td>2.22</td>
      <td>2.30</td>
      <td>2.38</td>
      <td>2.46</td>
      <td>2.54</td>
      <td>2.62</td>
      <td>2.71</td>
      <td>2.79</td>
      <td>2.88</td>
      <td>2.96</td>
      <td>3.04</td>
      <td>3.13</td>
      <td>3.21</td>
      <td>3.30</td>
      <td>3.38</td>
      <td>3.46</td>
      <td>3.54</td>
      <td>3.63</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],49)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.21</td>
      <td>1.29</td>
      <td>1.37</td>
      <td>1.45</td>
      <td>1.53</td>
      <td>1.62</td>
      <td>1.70</td>
      <td>1.79</td>
      <td>1.86</td>
      <td>1.93</td>
      <td>2.01</td>
      <td>2.10</td>
      <td>2.18</td>
      <td>2.25</td>
      <td>2.34</td>
      <td>2.42</td>
      <td>2.50</td>
      <td>2.58</td>
      <td>2.67</td>
      <td>2.75</td>
      <td>2.83</td>
      <td>2.91</td>
      <td>3.00</td>
      <td>3.07</td>
      <td>3.15</td>
      <td>3.23</td>
      <td>3.31</td>
      <td>3.39</td>
      <td>3.47</td>
      <td>3.56</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],50)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.18</td>
      <td>1.26</td>
      <td>1.34</td>
      <td>1.42</td>
      <td>1.50</td>
      <td>1.59</td>
      <td>1.66</td>
      <td>1.74</td>
      <td>1.82</td>
      <td>1.90</td>
      <td>1.98</td>
      <td>2.06</td>
      <td>2.14</td>
      <td>2.21</td>
      <td>2.30</td>
      <td>2.38</td>
      <td>2.46</td>
      <td>2.54</td>
      <td>2.62</td>
      <td>2.70</td>
      <td>2.78</td>
      <td>2.86</td>
      <td>2.94</td>
      <td>3.02</td>
      <td>3.10</td>
      <td>3.17</td>
      <td>3.25</td>
      <td>3.33</td>
      <td>3.41</td>
      <td>3.49</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],51)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.18</td>
      <td>1.26</td>
      <td>1.34</td>
      <td>1.42</td>
      <td>1.49</td>
      <td>1.57</td>
      <td>1.64</td>
      <td>1.71</td>
      <td>1.79</td>
      <td>1.87</td>
      <td>1.95</td>
      <td>2.02</td>
      <td>2.10</td>
      <td>2.18</td>
      <td>2.26</td>
      <td>2.34</td>
      <td>2.42</td>
      <td>2.49</td>
      <td>2.57</td>
      <td>2.65</td>
      <td>2.74</td>
      <td>2.82</td>
      <td>2.90</td>
      <td>2.97</td>
      <td>3.05</td>
      <td>3.13</td>
      <td>3.19</td>
      <td>3.27</td>
      <td>3.34</td>
      <td>3.42</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],52)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.16</td>
      <td>1.23</td>
      <td>1.31</td>
      <td>1.39</td>
      <td>1.46</td>
      <td>1.54</td>
      <td>1.61</td>
      <td>1.68</td>
      <td>1.76</td>
      <td>1.84</td>
      <td>1.92</td>
      <td>1.99</td>
      <td>2.06</td>
      <td>2.14</td>
      <td>2.22</td>
      <td>2.30</td>
      <td>2.38</td>
      <td>2.45</td>
      <td>2.53</td>
      <td>2.61</td>
      <td>2.68</td>
      <td>2.76</td>
      <td>2.84</td>
      <td>2.92</td>
      <td>3.00</td>
      <td>3.06</td>
      <td>3.13</td>
      <td>3.22</td>
      <td>3.30</td>
      <td>3.37</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],53)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.14</td>
      <td>1.21</td>
      <td>1.29</td>
      <td>1.36</td>
      <td>1.44</td>
      <td>1.51</td>
      <td>1.59</td>
      <td>1.66</td>
      <td>1.74</td>
      <td>1.81</td>
      <td>1.89</td>
      <td>1.96</td>
      <td>2.03</td>
      <td>2.10</td>
      <td>2.18</td>
      <td>2.26</td>
      <td>2.34</td>
      <td>2.41</td>
      <td>2.49</td>
      <td>2.57</td>
      <td>2.64</td>
      <td>2.71</td>
      <td>2.79</td>
      <td>2.86</td>
      <td>2.94</td>
      <td>3.01</td>
      <td>3.09</td>
      <td>3.16</td>
      <td>3.24</td>
      <td>3.31</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],54)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.12</td>
      <td>1.19</td>
      <td>1.27</td>
      <td>1.34</td>
      <td>1.41</td>
      <td>1.49</td>
      <td>1.56</td>
      <td>1.63</td>
      <td>1.71</td>
      <td>1.78</td>
      <td>1.86</td>
      <td>1.93</td>
      <td>2.00</td>
      <td>2.07</td>
      <td>2.15</td>
      <td>2.22</td>
      <td>2.30</td>
      <td>2.37</td>
      <td>2.45</td>
      <td>2.52</td>
      <td>2.59</td>
      <td>2.66</td>
      <td>2.74</td>
      <td>2.81</td>
      <td>2.89</td>
      <td>2.96</td>
      <td>3.04</td>
      <td>3.10</td>
      <td>3.17</td>
      <td>3.24</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],55)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.10</td>
      <td>1.17</td>
      <td>1.24</td>
      <td>1.31</td>
      <td>1.39</td>
      <td>1.46</td>
      <td>1.53</td>
      <td>1.60</td>
      <td>1.68</td>
      <td>1.75</td>
      <td>1.82</td>
      <td>1.89</td>
      <td>1.97</td>
      <td>2.04</td>
      <td>2.12</td>
      <td>2.18</td>
      <td>2.26</td>
      <td>2.33</td>
      <td>2.40</td>
      <td>2.47</td>
      <td>2.54</td>
      <td>2.62</td>
      <td>2.69</td>
      <td>2.76</td>
      <td>2.83</td>
      <td>2.89</td>
      <td>2.97</td>
      <td>3.04</td>
      <td>3.11</td>
      <td>3.18</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],56)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.07</td>
      <td>1.15</td>
      <td>1.22</td>
      <td>1.29</td>
      <td>1.36</td>
      <td>1.43</td>
      <td>1.50</td>
      <td>1.57</td>
      <td>1.65</td>
      <td>1.72</td>
      <td>1.79</td>
      <td>1.86</td>
      <td>1.93</td>
      <td>2.00</td>
      <td>2.08</td>
      <td>2.15</td>
      <td>2.22</td>
      <td>2.29</td>
      <td>2.36</td>
      <td>2.43</td>
      <td>2.50</td>
      <td>2.57</td>
      <td>2.64</td>
      <td>2.71</td>
      <td>2.78</td>
      <td>2.85</td>
      <td>2.92</td>
      <td>2.99</td>
      <td>3.06</td>
      <td>3.13</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],57)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.05</td>
      <td>1.12</td>
      <td>1.19</td>
      <td>1.26</td>
      <td>1.33</td>
      <td>1.40</td>
      <td>1.47</td>
      <td>1.54</td>
      <td>1.62</td>
      <td>1.70</td>
      <td>1.77</td>
      <td>1.83</td>
      <td>1.90</td>
      <td>1.97</td>
      <td>2.04</td>
      <td>2.11</td>
      <td>2.18</td>
      <td>2.25</td>
      <td>2.32</td>
      <td>2.39</td>
      <td>2.46</td>
      <td>2.53</td>
      <td>2.60</td>
      <td>2.66</td>
      <td>2.73</td>
      <td>2.80</td>
      <td>2.87</td>
      <td>2.94</td>
      <td>3.00</td>
      <td>3.08</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],58)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.03</td>
      <td>1.10</td>
      <td>1.17</td>
      <td>1.24</td>
      <td>1.30</td>
      <td>1.37</td>
      <td>1.44</td>
      <td>1.51</td>
      <td>1.59</td>
      <td>1.67</td>
      <td>1.74</td>
      <td>1.80</td>
      <td>1.87</td>
      <td>1.94</td>
      <td>2.01</td>
      <td>2.08</td>
      <td>2.15</td>
      <td>2.21</td>
      <td>2.28</td>
      <td>2.35</td>
      <td>2.42</td>
      <td>2.48</td>
      <td>2.55</td>
      <td>2.62</td>
      <td>2.69</td>
      <td>2.75</td>
      <td>2.82</td>
      <td>2.88</td>
      <td>2.95</td>
      <td>3.02</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],59)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.02</td>
      <td>1.09</td>
      <td>1.16</td>
      <td>1.22</td>
      <td>1.29</td>
      <td>1.36</td>
      <td>1.43</td>
      <td>1.49</td>
      <td>1.56</td>
      <td>1.64</td>
      <td>1.71</td>
      <td>1.77</td>
      <td>1.84</td>
      <td>1.91</td>
      <td>1.98</td>
      <td>2.04</td>
      <td>2.11</td>
      <td>2.17</td>
      <td>2.24</td>
      <td>2.31</td>
      <td>2.38</td>
      <td>2.43</td>
      <td>2.50</td>
      <td>2.57</td>
      <td>2.64</td>
      <td>2.70</td>
      <td>2.77</td>
      <td>2.84</td>
      <td>2.91</td>
      <td>2.97</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],60)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>1.01</td>
      <td>1.08</td>
      <td>1.15</td>
      <td>1.21</td>
      <td>1.28</td>
      <td>1.34</td>
      <td>1.41</td>
      <td>1.47</td>
      <td>1.54</td>
      <td>1.62</td>
      <td>1.68</td>
      <td>1.75</td>
      <td>1.82</td>
      <td>1.88</td>
      <td>1.95</td>
      <td>2.01</td>
      <td>2.08</td>
      <td>2.14</td>
      <td>2.21</td>
      <td>2.27</td>
      <td>2.34</td>
      <td>2.40</td>
      <td>2.47</td>
      <td>2.53</td>
      <td>2.60</td>
      <td>2.66</td>
      <td>2.73</td>
      <td>2.79</td>
      <td>2.86</td>
      <td>2.92</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],61)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.99</td>
      <td>1.05</td>
      <td>1.12</td>
      <td>1.18</td>
      <td>1.24</td>
      <td>1.31</td>
      <td>1.37</td>
      <td>1.44</td>
      <td>1.50</td>
      <td>1.57</td>
      <td>1.63</td>
      <td>1.69</td>
      <td>1.76</td>
      <td>1.82</td>
      <td>1.89</td>
      <td>1.95</td>
      <td>2.02</td>
      <td>2.08</td>
      <td>2.14</td>
      <td>2.21</td>
      <td>2.27</td>
      <td>2.34</td>
      <td>2.40</td>
      <td>2.47</td>
      <td>2.53</td>
      <td>2.59</td>
      <td>2.66</td>
      <td>2.72</td>
      <td>2.79</td>
      <td>2.85</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],62)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.96</td>
      <td>1.02</td>
      <td>1.09</td>
      <td>1.15</td>
      <td>1.21</td>
      <td>1.27</td>
      <td>1.34</td>
      <td>1.40</td>
      <td>1.46</td>
      <td>1.53</td>
      <td>1.59</td>
      <td>1.65</td>
      <td>1.71</td>
      <td>1.78</td>
      <td>1.84</td>
      <td>1.90</td>
      <td>1.97</td>
      <td>2.03</td>
      <td>2.09</td>
      <td>2.15</td>
      <td>2.22</td>
      <td>2.28</td>
      <td>2.34</td>
      <td>2.41</td>
      <td>2.47</td>
      <td>2.53</td>
      <td>2.59</td>
      <td>2.66</td>
      <td>2.72</td>
      <td>2.78</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],63)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.93</td>
      <td>0.99</td>
      <td>1.06</td>
      <td>1.12</td>
      <td>1.18</td>
      <td>1.24</td>
      <td>1.30</td>
      <td>1.36</td>
      <td>1.42</td>
      <td>1.49</td>
      <td>1.55</td>
      <td>1.61</td>
      <td>1.67</td>
      <td>1.73</td>
      <td>1.79</td>
      <td>1.85</td>
      <td>1.92</td>
      <td>1.98</td>
      <td>2.04</td>
      <td>2.10</td>
      <td>2.16</td>
      <td>2.22</td>
      <td>2.28</td>
      <td>2.35</td>
      <td>2.41</td>
      <td>2.47</td>
      <td>2.53</td>
      <td>2.59</td>
      <td>2.65</td>
      <td>2.71</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],64)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.91</td>
      <td>0.97</td>
      <td>1.03</td>
      <td>1.09</td>
      <td>1.15</td>
      <td>1.21</td>
      <td>1.27</td>
      <td>1.33</td>
      <td>1.39</td>
      <td>1.45</td>
      <td>1.51</td>
      <td>1.57</td>
      <td>1.63</td>
      <td>1.69</td>
      <td>1.75</td>
      <td>1.81</td>
      <td>1.87</td>
      <td>1.93</td>
      <td>1.99</td>
      <td>2.05</td>
      <td>2.11</td>
      <td>2.17</td>
      <td>2.23</td>
      <td>2.29</td>
      <td>2.35</td>
      <td>2.41</td>
      <td>2.47</td>
      <td>2.52</td>
      <td>2.58</td>
      <td>2.64</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],65)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.88</td>
      <td>0.94</td>
      <td>1.00</td>
      <td>1.06</td>
      <td>1.11</td>
      <td>1.17</td>
      <td>1.23</td>
      <td>1.29</td>
      <td>1.35</td>
      <td>1.41</td>
      <td>1.46</td>
      <td>1.52</td>
      <td>1.58</td>
      <td>1.64</td>
      <td>1.70</td>
      <td>1.76</td>
      <td>1.82</td>
      <td>1.87</td>
      <td>1.93</td>
      <td>1.99</td>
      <td>2.05</td>
      <td>2.11</td>
      <td>2.17</td>
      <td>2.23</td>
      <td>2.28</td>
      <td>2.34</td>
      <td>2.40</td>
      <td>2.46</td>
      <td>2.52</td>
      <td>2.58</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],66)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.85</td>
      <td>0.91</td>
      <td>0.97</td>
      <td>1.02</td>
      <td>1.08</td>
      <td>1.14</td>
      <td>1.20</td>
      <td>1.25</td>
      <td>1.31</td>
      <td>1.37</td>
      <td>1.42</td>
      <td>1.48</td>
      <td>1.54</td>
      <td>1.59</td>
      <td>1.65</td>
      <td>1.71</td>
      <td>1.77</td>
      <td>1.82</td>
      <td>1.88</td>
      <td>1.94</td>
      <td>1.99</td>
      <td>2.05</td>
      <td>2.11</td>
      <td>2.16</td>
      <td>2.22</td>
      <td>2.28</td>
      <td>2.34</td>
      <td>2.39</td>
      <td>2.45</td>
      <td>2.51</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],67)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.83</td>
      <td>0.88</td>
      <td>0.94</td>
      <td>0.99</td>
      <td>1.05</td>
      <td>1.10</td>
      <td>1.16</td>
      <td>1.22</td>
      <td>1.27</td>
      <td>1.33</td>
      <td>1.38</td>
      <td>1.44</td>
      <td>1.49</td>
      <td>1.55</td>
      <td>1.60</td>
      <td>1.66</td>
      <td>1.72</td>
      <td>1.77</td>
      <td>1.83</td>
      <td>1.88</td>
      <td>1.94</td>
      <td>1.99</td>
      <td>2.05</td>
      <td>2.10</td>
      <td>2.16</td>
      <td>2.22</td>
      <td>2.27</td>
      <td>2.33</td>
      <td>2.38</td>
      <td>2.44</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],68)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.80</td>
      <td>0.85</td>
      <td>0.91</td>
      <td>0.96</td>
      <td>1.02</td>
      <td>1.07</td>
      <td>1.12</td>
      <td>1.18</td>
      <td>1.23</td>
      <td>1.29</td>
      <td>1.34</td>
      <td>1.39</td>
      <td>1.45</td>
      <td>1.50</td>
      <td>1.56</td>
      <td>1.61</td>
      <td>1.67</td>
      <td>1.72</td>
      <td>1.77</td>
      <td>1.83</td>
      <td>1.88</td>
      <td>1.94</td>
      <td>1.99</td>
      <td>2.04</td>
      <td>2.10</td>
      <td>2.15</td>
      <td>2.21</td>
      <td>2.26</td>
      <td>2.32</td>
      <td>2.37</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],69)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.77</td>
      <td>0.83</td>
      <td>0.88</td>
      <td>0.93</td>
      <td>0.98</td>
      <td>1.04</td>
      <td>1.09</td>
      <td>1.14</td>
      <td>1.19</td>
      <td>1.25</td>
      <td>1.30</td>
      <td>1.35</td>
      <td>1.40</td>
      <td>1.46</td>
      <td>1.51</td>
      <td>1.56</td>
      <td>1.62</td>
      <td>1.67</td>
      <td>1.72</td>
      <td>1.77</td>
      <td>1.83</td>
      <td>1.88</td>
      <td>1.93</td>
      <td>1.98</td>
      <td>2.04</td>
      <td>2.09</td>
      <td>2.14</td>
      <td>2.20</td>
      <td>2.25</td>
      <td>2.30</td>
    </tr>
    <tr>
      <th><?php echo f_to_c($_SESSION['measTemp'],70)."&deg;".$_SESSION['measTemp']; ?></th>
      <td>0.75</td>
      <td>0.80</td>
      <td>0.85</td>
      <td>0.90</td>
      <td>0.95</td>
      <td>1.00</td>
      <td>1.05</td>
      <td>1.10</td>
      <td>1.16</td>
      <td>1.21</td>
      <td>1.26</td>
      <td>1.31</td>
      <td>1.36</td>
      <td>1.41</td>
      <td>1.46</td>
      <td>1.51</td>
      <td>1.57</td>
      <td>1.62</td>
      <td>1.67</td>
      <td>1.72</td>
      <td>1.77</td>
      <td>1.82</td>
      <td>1.87</td>
      <td>1.92</td>
      <td>1.98</td>
      <td>2.03</td>
      <td>2.08</td>
      <td>2.13</td>
      <td>2.18</td>
      <td>2.23</td>
    </tr>
    </tbody>
</table>